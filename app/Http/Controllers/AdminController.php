<?php

namespace App\Http\Controllers;
use DB;
use App\Models\User;
use App\Models\Student;
use App\Models\Incident;
use App\Models\Personnel;
use App\Models\Sos;
use Redirect;

use App\Notifications\UserActionNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AssignSos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //registering an admin
    public function createadmin(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $validuser=$request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],

            ]);
            if ($validuser) {
                $query2 = User::create([
                    'name' => $validuser['name'],
                    'email' => $validuser['email'],
                    'password' => Hash::make($validuser['password']),
                ]);
                if ($query2) {
                    return redirect('/home')->with('message','Admin registered successfully !');
                }else{
                    return redirect('/home')->with('message','Could not register, try again later !');
                }
            }
    }

    //student registration
    public function registerstudent(Request $request){
        $reg_no = $request->input('reg_no');
        $name = $request->input('name');
        $email = $request->input('email');
        $telephone = $request->input('telephone');
        $program = $request->input('program');
        $password = $request->input('password');
        $role = 1;

       
        $data = array(
            "reg_no" => $reg_no,
            "name" => $name,
            "email" => $email,
            "telephone" => $telephone,
            "program" => $program,
        );
        $query1 = DB::table('students')->insert($data);
        
        if($query1){
            $validuser=$request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            if (!$validuser) {
                DB::table('students')->where('reg_no', $reg_no)->delete();
            }else{
                $query2 = User::create([
                    'name' => $validuser['name'],
                    'email' => $validuser['email'],
                    'password' => Hash::make($validuser['password']),
                    'role'=> $role,
                ]);
                if ($query2) {
                    return redirect('/home')->with('message','Student registered successfully !');
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

    //displaying the sos table in blade view
    public function sostable(){
        $soss = Sos::join('students', 'sos.sender', '=', 'students.reg_no')
            ->select('sos.*', 'students.telephone')
            ->orderBy('created_at', 'DESC')->get();
        $incidents = Incident::orderBy('created_at', 'DESC')->get();
        $staffs = Personnel::where('status', 'Available')->get();
        return view('admin.sostable', compact('soss', 'incidents', 'staffs'));
    }

    //displaying all the system users
    public function allsuers(){
        $students = Student::all();
        $staffs = Personnel::all();
        return view('admin.allusers', compact('students', 'staffs'));
    }

    //displaying sos details in the modal for admission
    public function getsos(Request $request, $id){
        $sender = Sos::where('id', $id)->value('sender');
         return response()->json(array(
                'sender' => $sender,
            ));
    }

    //admitting sos that is confirmed to  be true
    public function admitsos(Request $request){
        $id = $request->input('sos_id');
        $sender = Sos::where('id', $id)->value('sender');
        $description = $request->input('description');
        $location = Sos::where('id', $id)->value('location');
        $longitude = Sos::where('id', $id)->value('longitude');
        $latitude = Sos::where('id', $id)->value('latitude');
        $incident_status = $request->input('status');
        $assigned_to = $request->input('personnel');
        $email = Personnel::where('work_id', $assigned_to)->value('email');

        $status = Sos::where('id', $id)->value('status');
        if($status == 'Admitted'){
            return redirect('/sostable')->with('message','Sorry, SOS already admitted !');
        }elseif($status == 'Dismissed'){
            return redirect('/sostable')->with('message','Sorry, SOS already dismissed !');
        }else{
            if($assigned_to == 'All Personnel are engaged at the moment!'){
                return redirect('/sostable')->with('message','Could not admit SOS, No available personnel !');
            }else{
                $incident_id = Incident::insertGetId([

                    'sender' => $sender,
                    'description' => $description,
                    'location' => $location,
                    'longitude' => $longitude,
                    'latitude' => $latitude,
                    'status' => $incident_status,
                    'assigned_to' => $assigned_to,
                    'remarks' => "awaiting personnel feedback",
                ]);
                $query1 = Incident::where('id', $incident_id)->count();
                if ($query1 == 1) {
                    $query2 = Sos::where('id', $id)->update(['status' => 'Admitted']);
                    $query3 = Personnel::where('work_id', $assigned_to)->update(['status' => 'Engaged']);
                    if($query2 && $query3){
                        $personnel = User::where('email', $email)->first();
                        
                        $notification = new AssignSos();
                        
                        $personnel->notify($notification);
                        
                        return redirect('/sostable')->with('message','SOS admitted successfully !');
                    }else{
                        Incident::where('id', $incident_id)->delete();
                        return redirect('/sostable')->with('message','Could not admit SOS, try again later !');
                    }
                    
                }else{
                    return redirect('/sostable')->with('message','Could not admit SOS, try again later !');
                }
            }
            
        }

        

    }

    //dismissing sos that is confirmed to  be a false alarm
    public function dismisssos(Request $request, $id){
        $query1 = Sos::where('id', $id)->value('status');
        
        if ($query1 == 'Admitted') {
            return redirect('/sostable')->with('message','Sorry, SOS already admitted !');
        }elseif($query1 == 'Dismissed'){
            return redirect('/sostable')->with('message','Sorry, SOS already dismissed !');
        }else{
            $query2 = Sos::where('id', $id)->update(['status' => 'Dismissed']);
            if ($query2) {
                return redirect('/sostable')->with('message','SOS dismissed successfully !');
            }else{
                return redirect('/sostable')->with('message','Could not dismiss SOS, try again later !');
            }
        }

    }

    //returning the map view
    public function mapview(){
        return view('admin.mapview');
    }
}
