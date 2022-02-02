<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $user = User::where('email',$request->email)->first();
        $tokenResult = $user->createToken('token')->accessToken;

        if ($user != NULL) {
            return response()->json([
                'result' => true,
                'message' => 'login success',
                'user' => $user,
                'token' => $tokenResult,
            ],200);
        }
        else {
            return response()->json([
                'result' => false,
                'message' => 'login failed',

            ],401);
        }
    }

}
