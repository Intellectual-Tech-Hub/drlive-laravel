<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//authentication
Route::post('/login', [App\Http\Controllers\api\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\api\AuthController::class, 'register']);

Route::group(['middleware'=>'auth:api'], function () {
    //Doctorsections
    Route::get('/category', [App\Http\Controllers\api\DoctorSectionController::class, 'category']);
    Route::post('/findcategory', [App\Http\Controllers\api\DoctorSectionController::class, 'findcategory']);
    Route::get('/doctors', [App\Http\Controllers\api\DoctorSectionController::class, 'doctors']);
    Route::post('/finddoctor', [App\Http\Controllers\api\DoctorSectionController::class, 'finddoctor']);
    Route::get('/stories', [App\Http\Controllers\api\StoryController::class, 'stories']);
    Route::get('/stories/active', [App\Http\Controllers\api\StoryController::class, 'activestories']);
    Route::post('/stories/user', [App\Http\Controllers\api\StoryController::class, 'userstories']);
    //User Section
    Route::post('/user/profile', [App\Http\Controllers\api\UserController::class, 'profiledetail']);
    Route::post('/user/update', [App\Http\Controllers\api\UserController::class, 'profileupdate']);
    //Appointment
    Route::post('/appointment/submit', [App\Http\Controllers\api\AppointmentController::class, 'appointmentsubmit']);

});