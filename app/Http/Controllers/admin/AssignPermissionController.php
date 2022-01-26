<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;

class AssignPermissionController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('admin.user-management.assign-permission.index',compact('roles'));
    }

    public function rolepermission($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.user-management.assign-permission.assign',compact('role','permissions'));
    }

    public function rolepermissionassign(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'guard_name' => 'required',
            'permissions' => 'required|array',
        ]);

        $role = Role::findByName($request->name);
        $status = $role->syncPermissions($request->permissions);

        if ($status) {
            Toastr::success('Permissions assigned', 'Success');
            return redirect()->route('role.lists');
        }
        else {
            Toastr::error('Permissions assigned failed', 'Failed');
            return redirect()->route('role.lists');
        }
    }

}
