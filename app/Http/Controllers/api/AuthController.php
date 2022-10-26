<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //doctor login
    public function login(Request $request)
    {

        if ($request->type == 'email') {
            $user = User::where('email',$request->email_or_phone)->first();

            if ($user != NULL) {
                if (Hash::check($request->password, $user->password) && $user->roles[0]['name'] == 'doctor') {
                    $tokenResult = $user->createToken('token')->accessToken;
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
                        'message' => 'authentication failed',
        
                    ],401);
                }
            }
            else {
                return response()->json([
                    'result' => false,
                    'message' => 'user not fount',

                ],404);
            }
        }
        elseif ($request->type == 'mobile') {
            $user = User::where('phone',$request->email_or_phone)->first();

            if ($user != NULL) {
                if (Hash::check($request->password, $user->password) && $user->roles[0]['name'] == 'doctor') {
                    $tokenResult = $user->createToken('token')->accessToken;
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
                        'message' => 'authentication failed',
        
                    ],401);
                }
            }
            else {
                return response()->json([
                    'result' => false,
                    'message' => 'user not fount',

                ],404);
            }
        }
        else {
            return response()->json([
                'result' => false,
                'message' => 'either use email or phone for login',

            ],401);
        }
    }

    //patient login
    public function mobile_login(Request $request)
    {
        if ($request->mobile == null) {
            return response()->json([
                'result' => false,
                'message' => 'please provide mobile number',
            ],200);
        }
        else {
            $user = User::where('phone',$request->mobile)->first();
            if ($user != null && $user->roles[0]['name'] == 'patient') {
                $tokenResult = $user->createToken('token')->accessToken;
                return response()->json([
                    'result' => true,
                    'message' => 'login success',
                    'user' => $user,
                    'token' => $tokenResult,
                ],200);
            }
            elseif ($user != null && $user->roles[0]['name'] != 'patient') {
                return response()->json([
                    'result' => false,
                    'message' => 'the user is not a patient, mobile number already taken',
                ],200);
            }
            else {
                $new_user = new User();
                $new_user->first_name = 'new patient';
                $new_user->phone = $request->mobile;
                $new_user->password = Hash::make('password');
                $new_user->gender = 'male';
                $new_user->save();
                $role = $new_user->assignRole('patient');
                $tokenResult = $new_user->createToken('token')->accessToken;

                return response()->json([
                    'result' => true,
                    'message' => 'new patient registered with this mobile number',
                    'user' => $new_user,
                    'token' => $tokenResult,
                ],200);
            }
        }
    }

    public function register(Request $request)
    {
        $user = User::where('email',$request->email_or_phone)->orWhere('phone',$request->email_or_phone)->first();
        if ($user != NULL) {
            return response()->json([
                'result' => false,
                'message' => 'user exists',

            ],401);
        }
        
        if ($request->type == 'email') {
            $new_user = new User();
            $new_user->first_name = $request->name;
            $new_user->email = $request->email_or_phone;
            $new_user->password = Hash::make($request->password);
            $new_user->gender = $request->gender;
            $new_user->dob = $request->dob;
            $new_user->save();
            $role = $new_user->assignRole('patient');
            $tokenResult = $new_user->createToken('token')->accessToken;

            return response()->json([
                'result' => true,
                'message' => 'registration success',
                'user' => $new_user,
                'token' => $tokenResult,
            ],200);
        } 
        elseif ($request->type == 'mobile') {
            $new_user = new User();
            $new_user->first_name = $request->name;
            $new_user->phone = $request->email_or_phone;
            $new_user->password = Hash::make($request->password);
            $new_user->gender = $request->gender;
            $new_user->dob = $request->dob;
            $new_user->save();
            $role = $new_user->assignRole('patient');
            $tokenResult = $new_user->createToken('token')->accessToken;

            return response()->json([
                'result' => true,
                'message' => 'registration success',
                'user' => $new_user,
                'token' => $tokenResult,
            ],200);
        }
        else {
            return response()->json([
                'result' => false,
                'message' => 'either use email or phone for registration',

            ],401);
        }

    }

}
