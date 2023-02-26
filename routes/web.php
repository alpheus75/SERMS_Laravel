<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PersonnelController;
use App\Http\Middleware\UserRoleMiddleware;


use App\Models\User;
use App\Models\Student;
use App\Models\Incident;
use App\Models\Personnel;
use App\Models\Sos;
use Illuminate\Support\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $reported = Incident::count();
    $resolved = Incident::where('status', 'Resolved')->count();
    $students = Student::count();
    $first = Sos::first();
    $date = $first->created_at;
    $today=Carbon::now();
    $years = $today->diffInYears($date);
    return view('welcom2', compact('reported', 'resolved', 'students', 'years'));
    
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('homepage');



Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');

//displyaing students registration form and storing the form
Route::get('/students', [App\Http\Controllers\HomeController::class, 'students'])->name('students');
Route::post('/createstudent', [App\Http\Controllers\StudentController::class, 'createstudent'])->name('createstudent');
Route::post('student/update', [App\Http\Controllers\StudentController::class, 'studentupdate'])->name('studentupdate');


Auth::routes(['register' => false]);

//admin routes
Route::middleware(['auth', 'user-role:0'])->group( function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //displaying personnel registration form and storing it
    Route::get('/personnel', [App\Http\Controllers\HomeController::class, 'personnel'])->name('personnel');
    Route::post('/createpersonnel', [App\Http\Controllers\PersonnelController::class, 'createpersonnel'])->name('createpersonnel');
    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
    Route::post('/createadmin', [App\Http\Controllers\AdminController::class, 'createadmin'])->name('createadmin');
    //displyaing students registration form and storing the form
    Route::get('/studentsform', [App\Http\Controllers\HomeController::class, 'studentsform'])->name('studentsform');
    Route::post('/registerstudent', [App\Http\Controllers\AdminController::class, 'registerstudent'])->name('registerstudent');
    Route::get('/sostable', [App\Http\Controllers\AdminController::class, 'sostable'])->name('sostableview');
    //displaying sos details in modal for admission
    Route::post('/getsos/{id}', [App\Http\Controllers\AdminController::class, 'getsos'])->name('getsos');
    //admitting an sos after confirmation
    Route::post('/admitsos', [App\Http\Controllers\AdminController::class, 'admitsos'])->name('admitsos');
    //updating student details
    Route::post('/updatestudent', [App\Http\Controllers\AdminController::class, 'updatestudent'])->name('updatestudent');
    //updating personnel details
    Route::post('/updatestaff', [App\Http\Controllers\AdminController::class, 'updatestaff'])->name('updatestaff');
    //deleting a studen or personnel from the database
    Route::get('/getuser/{id1}/{id2}', [App\Http\Controllers\AdminController::class, 'getuser'])->name('getuser');
    //dismissing an sos after confirmation
    Route::get('/dismisssos/{id}', [App\Http\Controllers\AdminController::class, 'dismisssos'])->name('dismisssos');
    //returning the map view blade
     Route::get('/map', [App\Http\Controllers\AdminController::class, 'mapview'])->name('mapview');
    //showing all the users
     Route::get('/users', [App\Http\Controllers\AdminController::class, 'allsuers'])->name('allsuers');
});

//student routes
//Route::post('student/update', [App\Http\Controllers\StudentController::class, 'studentupdate'])->name('studentupdate');
Route::middleware(['auth', 'user-role:1'])->group(function(){
    Route::get('/student/home', [App\Http\Controllers\StudentController::class, 'index'])->name('home.student');
    Route::get('/student/sos', [App\Http\Controllers\StudentController::class, 'sosview'])->name('sos.student');
    Route::post('/student/sosconnect', [App\Http\Controllers\StudentController::class, 'sosconnect'])->name('sos.save');
    Route::get('/student/webcam', [App\Http\Controllers\StudentController::class, 'webcam'])->name('webcam.student');
    Route::post('/student/webcamstore', [App\Http\Controllers\StudentController::class, 'webcamstore'])->name('webcam.store');
    Route::post('/student/update', [App\Http\Controllers\StudentController::class, 'studentupdate'])->name('update.student');
    Route::get('/student/incidents', [App\Http\Controllers\StudentController::class, 'myincidents'])->name('myincidents');
    Route::post('/student/rating', [App\Http\Controllers\StudentController::class, 'rateincident'])->name('rate.incident');



});

//personnel routes
Route::middleware(['auth', 'user-role:2'])->group(function(){
    Route::get('/staff/home', [App\Http\Controllers\PersonnelController::class, 'index'])->name('home.staff');
    Route::get('/tracesos/{id}', [App\Http\Controllers\PersonnelController::class, 'traceIncident'])->name('tracesos');
    Route::post('/incidentupdate', [App\Http\Controllers\PersonnelController::class, 'updateincident'])->name('updateincident');
    //returning the map view blade
     Route::get('/map', [App\Http\Controllers\PersonnelController::class, 'mapview'])->name('mapview');
});
