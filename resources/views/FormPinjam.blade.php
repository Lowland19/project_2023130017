@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container">
        <h1 class="text-center fw-bolder mb-3" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Form Peminjaman</h1>
        <div class="container rounded-3 p-5" style="background-color: #FFEDB8;">
            <div class="mb-3">
                <label class="form-label fw-bolder mb-0" for="judulBuku">Judul Buku</label>
                <input type="text" class="form-control" name="judulBuku" id="judulBuku" value="{{ $buku->namaBuku }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bolder mb-0" for="durasiPinjam">Durasi Pinjam</label>
                <input type="number" class="form-control" name="durasiPinjam" id="durasiPinjam">
            </div>
            <div class="mb-3">
                <label class="form label fw-bolder mb-0" for="tanggalPinjam">Tanggal Pinjam</label>
                <br>
                <input type="date" value="{{date('Y-m-d')}}">
            </div>
            <div class="mb-3">
                <label class="form label fw-bolder mb-0" for="tanggalPengembalian">Tanggal Pengembalian</label>
                <br>
                <input type="date" disabled value="">
            </div>
            <a href="#" class="btn btn-primary">Pinjam</a>
            <a href="#" class="btn btn-danger">Batal</a>
        </div>
    </div>
</div>
@endsection