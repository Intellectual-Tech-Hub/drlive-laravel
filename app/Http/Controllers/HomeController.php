<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

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
    }

    public function index()
    {
        return view('admin.index');
    }
}
