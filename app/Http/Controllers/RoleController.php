<?php

namespace App\Http\Controllers;

use Crypt;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function edit($encrypted_id)
    {
        $id = Crypt::decrypt($encrypted_id);
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('EditPermission', compact('role', 'permissions','rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $role->syncPermissions($request->permissions ?? []);
        return redirect()->route('admin.dashboard')->with('success', "Role berhasil diperbarui!")->with('active_tab', 'perizinan');
    }
}
