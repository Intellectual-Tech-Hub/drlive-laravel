<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permission:chat', ['only' => ['index']]);
        $this->middleware('permission:chat_settings', ['only' => ['setting']]);
    }


    public function index()
    {
        $users = User::get();
        return view('admin.chat.chat', compact('users'));
    }

}
