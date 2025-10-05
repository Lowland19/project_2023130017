<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
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
        ]);
        Buku::create($request->all());
        return redirect()->route('buku.index')->with('success','Buku berhasil ditambahkan');
    }

    public function edit(Buku $buku){
        return view('FormEditBuku',compact('buku'));
    }

    public function update(Request $request, Buku $buku){
        $request -> validate([
            'namaBuku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
        ]);
        $buku->update($request->all());
        return redirect()->route('buku.index')->with('success','Buku berhasil diubah');
    }

    public function destroy(Buku $buku){
        $buku->delete();
        return redirect()->route('buku.index')->with('success','Buku berhasil dihapus');
    }
}
