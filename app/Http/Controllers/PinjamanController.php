<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;

class PinjamanController extends Controller
{
    public function __construct(){
        $this -> middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        $pinjaman = Pinjaman::with('buku')->where('user_id', $user->id)->get();
        return view('DaftarPinjam', compact('pinjaman'));
    }
}
