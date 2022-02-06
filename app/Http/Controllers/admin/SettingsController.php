<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:web_settings', ['only' => ['index','save']]);
    }


    public function index()
    {
        $setting = Setting::orderBy('id','ASC')->first();
        return view('admin.settings.general', compact('setting'));
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'copyright' => 'required'
        ]);

        if ($request->id) {
            $setting = Setting::findOrFail($request->id);
            $setting->name = $request->name;

            if ($request->file('logo')) {
                Storage::delete('public/setting/'.$setting->logo);
                $image = $request->file('logo');
                $imagename = time() . '.' . $request->file('logo')->getClientOriginalName();
                $image->storeAs('public/setting', $imagename);
                $setting->logo = $imagename;
            }

            if ($request->file('fav_icon')) {
                Storage::delete('public/setting/'.$setting->fav_icon);
                $image = $request->file('fav_icon');
                $imagename = time() . '.' . $request->file('fav_icon')->getClientOriginalName();
                $image->storeAs('public/setting', $imagename);
                $setting->fav_icon = $imagename;
            }

            $setting->copyright = $request->copyright;
            $status = $setting->save();
        }
        else {
            $setting = new Setting();
            $setting->name = $request->name;

            if ($request->file('logo')) {
                $image = $request->file('logo');
                $imagename = time() . '.' . $request->file('logo')->getClientOriginalName();
                $image->storeAs('public/setting', $imagename);
                $setting->logo = $imagename;
            }

            if ($request->file('fav_icon')) {
                $image = $request->file('fav_icon');
                $imagename = time() . '.' . $request->file('fav_icon')->getClientOriginalName();
                $image->storeAs('public/setting', $imagename);
                $setting->fav_icon = $imagename;
            }

            $setting->copyright = $request->copyright;
            $status = $setting->save();
        }

        if ($status) {
            Toastr::success('setting saved','Success');
            return redirect()->route('settings.index');
        }
        else {
            Toastr::error('setting failed to save','Failed');
            return redirect()->route('settings.index');
        }
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('admin.settings.profile', compact('user'));
    }

    public function profilesave(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'gender' => 'required',
        ]);

        $user = User::findOrfail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->pin = $request->pin;
        $user->place = $request->place;
        $user->gender = $request->gender;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        else {
            $user->password = $user->password;
        }

        if ($request->file('image')) {
            Storage::delete('public/user/'.$user->image);
            $image = $request->file('image');
            $imagename = time() . '.' . $request->file('image')->getClientOriginalName();
            $image->storeAs('public/user', $imagename);
            $user->image = $imagename;
        }
        
        $status = $user->save();

        if ($status) {
            Toastr::success('Profile updated successfully','Success');
            return redirect()->route('profile',$id);
        }
        else {
            Toastr::error('Profile updation failed','Failed');
            return redirect()->route('profile',$id);
        }
    }

}
