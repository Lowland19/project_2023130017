<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Buku;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function index(){
        $user = User::all();
        $buku = Buku::all();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('AdminDashboard', compact('user','buku','roles','permissions'));
    }

    protected function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'alamat' => 'required|string',
            'nomortelepon' => 'required|string',
            'role' => 'required|string'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'nomortelepon' => $request->nomortelepon,
            'role' => $request->role,
        ]);
    }
}
