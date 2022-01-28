<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


//Authentication Routes
Auth::routes();
Route::redirect('/','/loginform');
Route::get('/loginform', [App\Http\Controllers\HomeController::class, 'login'])->name('login.form');
Route::post('/loginform/submit', [App\Http\Controllers\HomeController::class, 'loginsubmit'])->name('login.form.submit');
Route::get('/userlogout', [App\Http\Controllers\HomeController::class, 'logout'])->name('user.logout');

//Admin Routes
Route::group(['prefix'=>'admin', 'middleware'=>['auth']], function () {

    //dashboard
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //user management
    Route::resource('/roles', App\Http\Controllers\admin\RoleController::class);
    Route::resource('/users', App\Http\Controllers\admin\UserController::class);
    Route::get('/role/lists', [App\Http\Controllers\admin\AssignPermissionController::class, 'index'])->name('role.lists');
    Route::get('/role/permission/{id}', [App\Http\Controllers\admin\AssignPermissionController::class, 'rolepermission'])->name('role.permission');
    Route::post('/role/permission/assign', [App\Http\Controllers\admin\AssignPermissionController::class, 'rolepermissionassign'])->name('role.permission.assign');
    //Doctor section
    Route::resource('/category', App\Http\Controllers\admin\CategoryController::class);
    Route::resource('/doctor', App\Http\Controllers\admin\DoctorController::class);
    //Banners
    Route::resource('/banners', App\Http\Controllers\admin\BannerController::class);
    //Web Settings
    Route::get('/settings/index', [App\Http\Controllers\admin\SettingsController::class, 'index'])->name('settings.index');

});
