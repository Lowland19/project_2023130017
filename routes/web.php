<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\UserController;
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
Route::get('/user',[UserController::class,'show'])->name('user.profile');
Route::get('/buku/pinjam/{id}',[BukuController::class, 'pinjam'])->name('buku.pinjam');
Route::resource('buku',BukuController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('pinjaman',PinjamanController::class);


