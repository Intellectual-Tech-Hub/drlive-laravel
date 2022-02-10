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
    //Appointments Section
    Route::resource('/appointment', App\Http\Controllers\admin\AppointmentsController::class);
    Route::get('/appointments/history', [App\Http\Controllers\admin\AppointmentsController::class, 'history'])->name('appointments.history');
    //user management
    Route::resource('/roles', App\Http\Controllers\admin\RoleController::class);
    Route::resource('/users', App\Http\Controllers\admin\UserController::class);
    Route::get('/role/lists', [App\Http\Controllers\admin\AssignPermissionController::class, 'index'])->name('role.lists');
    Route::get('/role/permission/{id}', [App\Http\Controllers\admin\AssignPermissionController::class, 'rolepermission'])->name('role.permission');
    Route::post('/role/permission/assign', [App\Http\Controllers\admin\AssignPermissionController::class, 'rolepermissionassign'])->name('role.permission.assign');
    //Doctor section
    Route::resource('/category', App\Http\Controllers\admin\CategoryController::class);
    Route::resource('/doctor', App\Http\Controllers\admin\DoctorController::class);
    Route::resource('/timeslots', App\Http\Controllers\admin\TimeSlotController::class);
    Route::resource('/availability', App\Http\Controllers\admin\DoctorAvailabilityController::class);
    Route::resource('/fees', App\Http\Controllers\admin\DoctorFeesController::class);
    //Medicines Section
    Route::resource('/medicinetype', App\Http\Controllers\admin\MedicineTypeController::class);
    Route::resource('/medicine', App\Http\Controllers\admin\MedicineController::class);
    //General Options
    Route::resource('/banners', App\Http\Controllers\admin\BannerController::class);
    Route::resource('/story', App\Http\Controllers\admin\StoriesController::class);
    Route::get('/chat', [App\Http\Controllers\admin\ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/start/{id}', [App\Http\Controllers\admin\ChatController::class, 'startchat'])->name('chat.start');
    Route::post('/chat/send', [App\Http\Controllers\admin\ChatController::class, 'send'])->name('chat.send');
    //leave management
    Route::resource('/leave', App\Http\Controllers\admin\LeaveController::class);
    Route::resource('/leavedefine', App\Http\Controllers\admin\LeavedefineController::class);
    Route::resource('/leaveapprove', App\Http\Controllers\admin\Approve_leave::class);
    Route::get('/storeapprovestatus/{status}',[Approve_leave::class,'approvestatus'])->name('store.approvestatus');
    Route::get('/storedeclinestatus/{status}',[Approve_leave::class,'declinestatus'])->name('store.declinestatus');
    Route::get('/storeapprovestatuspending/{status}',[PendingLeave::class,'approvependingstatus'])->name('store.approvependingstatus');
    Route::get('/storedeclinestatuspending/{status}',[PendingLeave::class,'declinependingstatus'])->name('store.declinependingstatus');
    Route::resource('/pendingleaves',App\Http\Controllers\admin\PendingLeave::class);
    //Web Settings
    Route::get('/settings/index', [App\Http\Controllers\admin\SettingsController::class, 'index'])->name('settings.index');
    Route::any('/settings/save', [App\Http\Controllers\admin\SettingsController::class, 'save'])->name('settings.save');
    Route::get('/profile/{id}', [App\Http\Controllers\admin\SettingsController::class, 'profile'])->name('profile');
    Route::any('/profile/save/{id}', [App\Http\Controllers\admin\SettingsController::class, 'profilesave'])->name('profile.save');

});

//Ajax Routes
Route::get('/getdoctors', [App\Http\Controllers\admin\AjaxController::class, 'getdoctors']);
