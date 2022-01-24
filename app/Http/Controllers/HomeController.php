<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginsubmit(Request $request)
    {
        return $request;
    }

    public function index()
    {
        return view('admin.index');
    }
}
