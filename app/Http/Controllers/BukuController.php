<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Crypt;
class BukuController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth') -> except('index');
    }

    public function index(){
        $buku = Buku::all();
        return view('DaftarBuku',compact('buku'));
    }

    public function create(){
        return view('FormTambahBuku');
    }

    public function store(Request $request){
        $request -> validate([
            'namaBuku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            ''
        ]);
        Buku::create($request->all());
        return redirect()->route('buku.index')->with('success','Buku berhasil ditambahkan');
    }

    public function edit($encrypted_id){
        $id = Crypt::decrypt($encrypted_id);
        $buku = Buku::find($id);
        return view('FormEditBuku',compact('buku'));
    }

    public function update(Request $request, Buku $buku){
        $request -> validate([
            'namaBuku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
        ]);
        $buku->update($request->all());
        return redirect()->route('admin.dashboard')->with('success', "Buku berhasil diubah!")->with('active_tab', 'daftar-buku-admin');
    }

    public function destroy(Buku $buku){
        $buku->delete();
        return redirect()->route('admin.dashboard')->with('success', "Buku berhasil dihapus!")->with('active_tab', 'daftar-buku-admin');
    }

    public function show(Buku $buku){
        return view('DetailBuku', compact('buku'));
    }

    public function pinjam($encrypted_id){
        $id = Crypt::decrypt($encrypted_id);
        $buku = Buku::findOrFail($id);
        return view('FormPinjam', compact('buku'));
    }
}
