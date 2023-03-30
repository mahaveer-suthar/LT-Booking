<?php

use App\Http\Controllers\admin\Lt_roomController;
use App\Http\Controllers\admin\ProfessorController;
use App\Http\Controllers\admin\RequestController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\admin\TeacherController;
use App\Http\Controllers\Admin\TimetableController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\user\BookingController;
use App\Http\Controllers\user\CreateBookinController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleController;

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

// Made By: Akshat Mathur (20UCC014), Aviral Taneja (20UCC027)
Route::get('/',function(){
    return redirect(route('login'));
});
Route::prefix('google')->name('google.')->group( function(){
  Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
  Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});

//Admin Routes Role 1
Route::group(['prefix' => '/admin','as' => 'admin.', 'middleware'=>['is_admin','auth']], function () {
    Route::get('/home', [HomeController::class, 'adminHome'])->name('home');
    Route::post('/change_status', [HomeController::class, 'changeStatus'])->name('changeRequestStatus');
    Route::resource('professor', ProfessorController::class);
    // Route::resource('lt_room', Lt_roomController::class);
    // Route::post('/changeStatus',[Lt_roomController::class,'changeStatus'])->name('changeStatus');
    Route::get('/timetable',[TimetableController::class,'index'])->name('timetable');
    Route::post('/timetable',[TimetableController::class,'upload'])->name('upload');
    Route::delete('/reset/{id}',[TimetableController::class,'reset'])->name('reset');
    Route::resource('/student',StudentController::class);
    Route::resource('/request',RequestController::class);
    Route::resource('/teachers',TeacherController::class);
  });


//Teacher Routes Role 2
Route::group(['prefix'=>'/teacher', 'as'=>'teacher.','middleware'=>['auth','is_teacher']], function () {
  Route::get('/home', [HomeController::class, 'teacherHome'])->name('home');
  Route::resource('/booking', BookingController::class);
  Route::post('/applyRequest',[BookingController::class,'applyRequest'])->name('applyRequest');
  Route::post('pw_change',[HomeController::class,'pw_change'])->name('pw_change');
});

//Student bodies Routes Role 3
Route::group(['prefix'=>'/student', 'as'=>'student.','middleware'=>['auth','is_student']], function () {
      Route::get('/home', [HomeController::class, 'studentHome'])->name('home');
      Route::resource('/booking', BookingController::class);
      Route::post('/applyRequest',[BookingController::class,'applyRequest'])->name('applyRequest');
      Route::post('pw_change',[HomeController::class,'pw_change'])->name('pw_change');
});

//User Routes Role 4
Route::group(['prefix' => '/user','as' => 'user.', 'middleware'=>['auth','is_user']], function () {
  Route::get('/home', [HomeController::class, 'userHome'])->name('home');
  });
Route::group(['prefix' => '/dean','as' => 'dean.', 'middleware'=>['auth']], function () {
  Route::get('/home', [HomeController::class, 'adminHome'])->name('home');
  Route::post('/change_status', [HomeController::class, 'changeStatus'])->name('changeRequestStatus');
  });

Auth::routes();


