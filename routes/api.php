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
//Doctorsections
Route::get('/category', [App\Http\Controllers\api\DoctorSectionController::class, 'category']);
Route::post('/findcategory', [App\Http\Controllers\api\DoctorSectionController::class, 'findcategory']);
Route::get('/doctors', [App\Http\Controllers\api\DoctorSectionController::class, 'doctors']);
Route::post('/finddoctor', [App\Http\Controllers\api\DoctorSectionController::class, 'finddoctor']);