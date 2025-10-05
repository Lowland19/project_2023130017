@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2>Form Tambah Buku</h2>
    <form action="{{route('buku.update', $buku->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="namaBuku" class="form-label">Judul Buku</label>
            <input type="text" name="namaBuku" id="namaBuku" class="form-control" required value="{{$buku->namaBuku}}">
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" name="penulis" id="penulis" class="form-control" required value="{{$buku->penulis}}">
        </div>
        <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" name="penerbit" id="penerbit" class="form-control" required value="{{$buku->penerbit}}">
        </div>
        <div class="mb-3">
            <label for="statusTersedia" class="form-label">Status Tersedia</label>
            <input type="hidden" name="statusTersedia" value="0">
            <input type="checkbox" name="statusTersedia" id="statusTersedia" value="1" {{ $buku->statusTersedia ? 'checked' : '' }}>
        </div>
        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="{{route('buku.index')}}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection