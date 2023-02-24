<?php

namespace App\Http\Controllers;
use DB;
use App\Models\User;
use App\Models\Student;
use App\Models\Incident;
use App\Models\Personnel;
use App\Models\Sos;
use Carbon;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['students','personnel']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        $soss = Sos::select(DB::raw("COUNT(*) as count"), DB::raw("date_format(sos.created_at, '%Y-%m-%d') as month_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("month_name"))
                    ->orderBy('month_name','ASC')
                    ->pluck('count', 'month_name');
        $incidents = Incident::select(DB::raw("COUNT(*) as count"), DB::raw("date_format(incidents.created_at, '%Y-%m-%d') as month_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("month_name"))
                    ->orderBy('month_name','ASC')
                    ->pluck('count', 'month_name');
        $labels = $soss->keys();
        $sos= $soss->values();
        $incident_labels = $incidents->keys();
        $incident= $incidents->values();
        $first = Sos::get();
        $date = $first->first()->created_at->format('M Y');
        $students = Student::count();
        $all_sos = Sos::count();
        $confirmed = Incident::count();
        $resolved = Incident::where('status', 'Resolved')->count();
        return view('admin.dashboard', compact('labels', 'sos', 'incident_labels', 'incident', 'students', 'all_sos', 'confirmed', 'resolved', 'date'));
    }

    public function home()
    {
        $reported = Incident::count();
        $resolved = Incident::where('status', 'Resolved')->count();
        $students = Student::count();
        $first = Sos::get();
        $date = $first->first('created_at');
        $today=Carbon::now();
        $years = $today->diffForHumans($date);
        //return view('welcom2', compact('reported', 'resolved', 'students'));
    }

    public function students()
    {
        return view('student.studentregister');
    }

    public function personnel()
    {
        return view('personnel.register');
    }

    public function admin()
    {
        return view('admin.register');
    }

    //showing student reg form to the admin for registration
    public function studentsform()
    {
        return view('admin.studentregform');
    }
}
