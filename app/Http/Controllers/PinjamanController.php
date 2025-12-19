<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;
use Illuminate\Support\Facades\Crypt;

class PinjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $pinjaman = Pinjaman::with('buku')
            ->where('idPeminjam', $user->id) // Pastikan kolom ini ada di tabel pinjaman
            ->doesntHave('pengembalian') 
            ->get();
        return view('DaftarPinjam', compact('pinjaman'));
    }

    public function create($encrypted_id)
    {   
        $id = Crypt::decrypt($encrypted_id);
        $buku = Buku::find($id);
        return view('FormPinjam', compact('buku'));
    }

    public function store(Request $request) {
        $request->validate([
            'idBuku'=> 'required',
            'idPeminjam' => 'required',
            'tanggalAwalPinjam' => 'required',
            'tanggalPengembalian' => 'required',
            'durasiPinjam' => 'required']);
        $buku = Buku::findOrFail($request->idBuku);
        if($buku->statusTersedia == 0){
        return redirect()->route('pinjaman.dashboard')->with('error','Maaf, buku ini sudah dipinjam orang lain.');
        }
        Pinjaman::create($request->all());
        $buku->statusTersedia = 0;
        $buku->save();
        return redirect()->route('pinjaman.dashboard')->with('success','');
    }
}
