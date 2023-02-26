<?php

namespace App\Http\Controllers;
use DB;
use App\Models\User;
use App\Models\Student;
use App\Models\Incident;
use App\Models\Personnel;
use App\Models\Sos;
use App\Notifications\UserActionNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SentSos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Storage;

class StudentController extends Controller
{
    //return student dashboard
    public function index()
    {
        $user = auth()->user();
        $email = $user['email'];
        $sender = Student::where('email', $email)->value('reg_no');
        $reported = Sos::where('sender', $sender)->count();
        
        $date = Student::where('email', $email)->value('created_at')->format('M Y');
        $sos = Sos::where('sender', $sender)->paginate(10);
        $resolve = Incident::where('sender', $sender)->paginate(10);
        $name = Student::where('email', $email)->value('name');
        $tel = Student::where('email', $email)->value('telephone');
        $program = Student::where('email', $email)->value('program');
        if($reported == 0){
            $resolved = 0;
            $dismissed = 0;
            $this->myincidents($reported, $date, $resolved, $dismissed);
            return view('student.dashboard', compact('reported', 'resolved', 'date', 'sos', 'resolve', 'dismissed', 'name', 'sender', 'tel', 'program', 'email'));
        }else{
            $resolved = Incident::where('sender', $sender)->where('status', 'Resolved')->count();
            $dismissed = Incident::where('sender', $sender)->where('status', 'Dismissed')->count();
            $this->myincidents($reported, $date, $resolved, $dismissed);
            return view('student.dashboard', compact('reported', 'resolved', 'date', 'sos', 'resolve', 'dismissed', 'name', 'sender', 'tel', 'program', 'email'));
        }
    }

    //student registration
    public function createstudent(Request $request){
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
                    dd("Student registered successfully");
                }else{
                    dd("Could not register, try again later");
                }
            }
            
            
            
        }else{
            return $e->getMessage();
            //echo "Student user could not be registered.<br/>";
            //echo '<a href = "/home">Click Here</a> to go back.';
        }
    }

    //taking IP address GPS coordinates and storing them
    public function sosview(){
        $ip = '49.35.41.195'; //For static IP address get
        //$ip = request()->ip(); //Dynamic IP address get
        $data = \Location::get($ip);
        $user = auth()->user();
        $email = $user['email'];
        $sender = Student::where('email', $email)->value('reg_no');
        $location = $data->regionName;
        $longitude = $data->longitude;
        $latitude = $data->latitude;

        $query1 = Sos::create([
            'sender' => $sender,
            'location' =>$location,
            'longitude' => $longitude,
            'latitude' => $latitude,
            'status' => 'Pending',
        ]);
        if ($query1) {
            $admins = User::where('role', 0)->get();
            //$admins->notify(new SentSos());
            $notification = new SentSos();
            foreach ($admins as $admin) {
                $admin->notify($notification);
            }
            return redirect('/student/home')->with('message','SOS Received, hung on as we try to help !');
            //return view('student.ipview', compact('data'));
        }else{
            return redirect('/student/home')->with('message','Could not receive your location, try again !');
        }
        
    }

    //displaying the webcam blade view
    public function webcam(){
        return view('student.webcam');
    }

    //saving the captured image
     public function webcamstore(Request $request){
        $img = $request->image;

        $folderPath = "./sceness/";

        

        $image_parts = explode(";base64,", $img);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = uniqid() . '.png';

        

        $file = $folderPath . $fileName;

        $query1 = Storage::put($file, $image_base64);
        if ($query1) {
            return redirect('/student/home')->with('message','Image Received, hung on as we try to help !');
        }else{
            return redirect('/student/home')->with('message','Could not receive your image, try again !');
        }
    }

    //displaying student details in editing modal modal
    public function studentupdate(Request $request){
        dd('Hello World');
        $data = $request->all();
        $user = auth()->user();
        $email = $request->input('email');
        $phone = $request->input('phone');

        $query1 = Student::where('name', $user)->update(['email' => $email], ['telephone' => $phone]);
        if ($query1) {
            $query2 = User::where('name', $user)->update(['email' => $email]);
            if ($query2) {
                return response()->json(['success' => true]);
            }else{
                return response()->json(['success' => false]);
            }
        }else{
            return response()->json(['success' => false]);
        }

        

    }

    //displaying the students incidences
    public function myincidents(){
        $user = auth()->user();
        $email = $user['email'];
        $sender = Student::where('email', $email)->value('reg_no');
        $reported = Sos::where('sender', $sender)->count();
        
        $date = Student::where('email', $email)->value('created_at')->format('M Y');
        $incidents = Incident::where('sender', $sender)->where('status', 'Resolved')->get();
        if($reported == 0){
            $resolved = 0;
            $dismissed = 0;

            return view('student.incidents', compact('reported', 'date', 'resolved', 'dismissed', 'incidents'));
        }else{
            $resolved = Incident::where('sender', $sender)->where('status', 'Resolved')->count();
            $dismissed = Incident::where('sender', $sender)->where('status', 'Dismissed')->count();
            return view('student.incidents', compact('reported', 'date', 'resolved', 'dismissed', 'incidents'));
        }
    }

    //rating an incident
    public function rateincident(Request $request){
        $id = $request->input('incident_id');
        $incident_rate = $request->input('incident_rate');
        $staff_rate = $request->input('staff_rate');

        $personnel = Incident::where('id', $id)->value('assigned_to');
        $old_rate = Incident::where('id', $id)->value('rating');

        $new_rate = $old_rate + $staff_rate;

        $query1 = Incident::where('id', $id)->value('rating');
        if ($query1 == 0) {
            $query2 = Incident::where('id', $id)->update(['rating' => $incident_rate]);
            $query3 = Personnel::where('work_id', $personnel)->update(['rating' => $new_rate]);
            if($query2 && $query3){
                return redirect('/student/incidents')->with('message','Thank you for the review, it helps us serve you better !');
            }else{
                return redirect('/student/incidents')->with('message','Could not capture you review, try again or contact support !');
            }
        }else{
            return redirect('/student/incidents')->with('message','You had rated the incident already, contact support !');
        }
    }
}
