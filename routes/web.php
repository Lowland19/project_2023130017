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
