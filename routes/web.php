<?php

use App\Http\Controllers\admin\Lt_roomController;
use App\Http\Controllers\admin\ProfessorController;
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
Route::get('/',function(){
    return redirect(route('login'));
});
Route::prefix('google')->name('google.')->group( function(){
  Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
  Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});
Auth::routes();


Route::group(['prefix' => '/admin','as' => 'admin.', 'middleware'=>['is_admin','auth']], function () {
    Route::get('/home', [HomeController::class, 'adminHome'])->name('home');
    Route::post('/change_status', [HomeController::class, 'changeStatus'])->name('changeRequestStatus');
    Route::resource('professor', ProfessorController::class);
    // Route::resource('lt_room', Lt_roomController::class);
    // Route::post('/changeStatus',[Lt_roomController::class,'changeStatus'])->name('changeStatus');
    Route::get('/timetable',[TimetableController::class,'index'])->name('timetable');
    Route::post('/timetable',[TimetableController::class,'upload'])->name('upload');
  });


Route::group(['prefix' => '/user','as' => 'user.', 'middleware'=>['auth','is_user']], function () {
      Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
      Route::resource('/booking', BookingController::class);
      Route::post('/applyRequest',[BookingController::class,'applyRequest'])->name('applyRequest');
  });
