<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:web_settings', ['only' => ['index','store']]);
    }


    public function index()
    {
        
    }

}
