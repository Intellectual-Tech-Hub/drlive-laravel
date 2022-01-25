<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginsubmit(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password, 'status'=>1])) {
            Toastr::success('Login success', 'Success');
            return redirect()->route('home');
        }
        elseif (Auth::attempt(['email'=>$request->email, 'password'=>$request->password, 'status'=>0])) {
            Toastr::error('User is not active', 'Failed');
            return redirect()->route('login.form');
        }
        else {
            Toastr::error('Login failed', 'Failed');
            return redirect()->route('login.form');
        }
    }

    public function logout()
    {
        Auth::logout();
        Toastr::success('Logout Successfull', 'Success');
        return redirect()->route('login.form');
    }

    public function index()
    {
        return view('admin.index');
    }
}
