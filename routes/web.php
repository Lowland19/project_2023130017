<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Pinjaman;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('AdminDashboard');
})->name('dashboard');
Route::get('/riwayatPeminjaman', function () {
    return view('RiwayatPeminjaman');
})->name('riwayat');
Route::get('/reload-captcha', function () {
    return response()->json(['captcha' => captcha_img('math')]);
});
Route::get('/pinjaman/dashboard',[PinjamanController::class,'index'])->name('pinjaman.dashboard');
Route::get('/pinjaman/store',[PinjamanController::class,'store'])->name('pinjaman.store');
Route::post('/admin/register', [AdminController::class, 'store'])
    ->middleware('auth')
    ->name('admin.store');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('permission:lihatdashboardadmin');
Route::get('/user', [UserController::class, 'show'])->name('user.profile');
Route::get('/buku/pinjam/{id}', [BukuController::class, 'pinjam'])->name('buku.pinjam');
Route::get('/role/edit/{id}',[RoleController::class,'edit'])->name('role.edit');
Route::resource('buku', BukuController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('pinjaman', PinjamanController::class);
Route::resource('pengembalian', PengembalianController::class);
Route::resource('roles', RoleController::class);
Route::put('/admin/users/{user}/update-role', [AdminController::class, 'updateRole'])->name('admin.users.updateRole');
Route::put('/pengembalian/{id}/upload', [PengembalianController::class, 'uploadBukti'])
    ->name('pengembalian.uploadBukti');
Route::patch('/admin/verifikasi-pembayaran/{id}', [AdminController::class, 'verifikasiPembayaran'])
    ->name('admin.verifikasi_pembayaran');
Route::get('/pinjaman/create/{id}', [PinjamanController::class, 'create'])->name('pinjaman.create');
Route::get('/admin/export-dashboard', [AdminController::class, 'exportDashboard'])->name('admin.export');
Route::middleware('auth')->group(function () {
    // Route untuk menampilkan halaman (GET)
    Route::get('/profil', [UserController::class, 'index'])->name('user.profile');
    
    // Route untuk memproses update (PUT)
    Route::put('/profil/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
});