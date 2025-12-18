<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('EditPermission', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $role->syncPermissions($request->permissions ?? []);
        return redirect()->back()->with('success', 'Permission berhasil diubah');
    }
}
