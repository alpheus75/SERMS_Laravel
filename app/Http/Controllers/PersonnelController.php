<?php

namespace App\Http\Controllers;
use DB;
use App\Models\User;
use App\Models\Student;
use App\Models\Incident;
use App\Models\Personnel;
use Redirect;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PersonnelController extends Controller
{
    
    //return personnel dashboard
    public function index()
    {
        $user = auth()->user();
        $email = $user['email'];
        $work_id = Personnel::where('email', $email)->value('work_id');
        $assigned = Incident::where('assigned_to', $work_id)->count();
        $resolved = Incident::where('assigned_to', $work_id)->where('status', 'Resolved')->count();
        $date = Personnel::where('email', $email)->value('created_at')->format('M Y');
        $actives = Incident::where('assigned_to', $work_id)
                ->where('status', 'Active')
                ->join('students', 'incidents.sender', '=', 'students.reg_no')
                ->select('incidents.*', 'students.telephone')
                ->orderBy('created_at', 'DESC')->get();
        $incidents = Incident::where('assigned_to', $work_id)
                ->join('students', 'incidents.sender', '=', 'students.reg_no')
                ->select('incidents.*', 'students.telephone')
                ->orderBy('created_at', 'DESC')->get();
        $rated_times = Incident::where('assigned_to', $work_id)->where('rating', '>', 0)->count();
        $total_rate = 5 * $rated_times;
        $rating = Personnel::where('work_id', $work_id)->value('rating') / $total_rate * 100;
        return view('personnel.dashboard', compact('assigned', 'resolved', 'date', 'actives', 'incidents', 'rating'));
    }

    //Personnel registration
    public function createpersonnel(Request $request){
        $work_id = $request->input('work_id');
        $name = $request->input('name');
        $email = $request->input('email');
        $telephone = $request->input('telephone');
        $password = $request->input('password');
        $role = 2;

       
        $data = array(
            "work_id" => $work_id,
            "name" => $name,
            "email" => $email,
            "telephone" => $telephone,
        );
        $query1 = DB::table('personnels')->insert($data);
        
        if($query1){
            $validuser=$request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],

            ]);
            if (!$validuser) {
                DB::table('personnels')->where('work_id', $work_id)->delete();
            }else{
                $query2 = User::create([
                    'name' => $validuser['name'],
                    'email' => $validuser['email'],
                    'password' => Hash::make($validuser['password']),
                    'role' => $role,
                ]);
                if ($query2) {
                    return redirect('/home')->with('message','Personnel registered successfully !');
                }else{
                    return redirect('/home')->with('message','Could not register, try again later !');
                }
            }
            
            
            
        }else{
            return $e->getMessage();
            //echo "Student user could not be registered.<br/>";
            //echo '<a href = "/home">Click Here</a> to go back.';
        }
        
        

    }

    //tracing the incident
    public function traceIncident(Request $request, $id){
        $longitude = Incident::where('id', $id)->value('longitude');
        $latitude = Incident::where('id', $id)->value('latitude');

        return view('personnel.mapview', compact('longitude', 'latitude'));
    }

    //updating the incident
    public function updateincident(Request $request){
        $id = $request->input('incident_id');
        $remarks = $request->input('remarks');
        $status = $request->input('status');
        //console.log($remarks);
        $query1 = Incident::where('id', $id)->update(['status' => $status, 'remarks' => $remarks]);
        if($query1){
            $personnel = Incident::where('id', $id)->value('assigned_to');
            $query2 = Personnel::where('work_id', $personnel)->update(['status' => 'Available']);
            if ($query2) {
                return redirect('/staff/home')->with('message','State of the incident update successfully !');
            }else{
                return redirect('/staff/home')->with('message','Could not Update the Incident, try again later !');
            }
        }else{
            return redirect('/staff/home')->with('message','Could not Update the Incident, try again later !');
        }
    }

    //returning the map view
    public function mapview(){
        return view('admin.mapview');
    }
}
