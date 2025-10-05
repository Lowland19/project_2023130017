@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2>Form Tambah Buku</h2>
    <form action="{{route('buku.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="namaBuku" class="form-label">Judul Buku</label>
            <input type="text" name="namaBuku" id="namaBuku" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" name="penulis" id="penulis" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" name="penerbit" id="penerbit" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Tambah</button>
    </form>
</div>
@endsection