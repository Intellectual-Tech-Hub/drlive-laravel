<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;

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

}
