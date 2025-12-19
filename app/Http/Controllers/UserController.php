<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use Hash;

class UserController extends Controller
{
    public function show()
    {
        return view('ProfilPengguna');
    }

    public function edit(User $user)
    {
        $roles = Role::all(); // Mengambil semua role yang tersedia
        return view('admin.users.edit_role', compact('user', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        // Validasi role yang dipilih
        $request->validate([
            'role' => 'required|exists:roles,name'
        ]);

        // Spatie: Menghapus role lama dan memberikan role baru
        $user->syncRoles($request->role);

        return redirect()->back()->with('success', 'Role pengguna berhasil diperbarui!');
    }

    public function updateProfile(Request $request)
{
    // 1. Ambil data user yang sedang login
    $user = Auth::user();

    // 2. Validasi Input
    $request->validate([
        'name'  => 'required|string|max:255',
        // Validasi email unik tapi KECUALIKAN email milik user ini sendiri
        'email' => [
            'required', 
            'email', 
            'max:255', 
            Rule::unique('users')->ignore($user->id), 
        ],
        // Password opsional (nullable), tapi jika diisi harus minimal 8 karakter & confirmed
        'password' => 'nullable|min:8|confirmed',
    ]);

    // 3. Update Data Dasar (Nama & Email)
    $user->name = $request->name;
    $user->email = $request->email;

    // 4. Update Password (Hanya jika user mengisi kolom password)
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // 5. Simpan ke Database
    $user->save(); // Karena $user adalah instance model User, method save() bisa langsung dipakai.

    // 6. Kembali ke halaman profil dengan pesan sukses
    return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
}
}
