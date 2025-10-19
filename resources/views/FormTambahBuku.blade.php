@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container">
        <h1 class="text-center fw-bolder mb-3" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Form Tambah Buku</h1>
        <div class="container rounded-3 p-5" style="background-color: #FFEDB8;">
            <form action="{{route('buku.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="namaBuku" class="form-label fw-bolder mb-0">Judul Buku</label>
                    <input type="text" name="namaBuku" id="namaBuku" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="penulis" class="form-label fw-bolder mb-0">Penulis</label>
                    <input type="text" name="penulis" id="penulis" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="penerbit" class="form-label fw-bolder mb-0">Penerbit</label>
                    <input type="text" name="penerbit" id="penerbit" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success fw-bolder mb-0">Tambah</button>
            </form>
        </div>
    </div>
</div>
@endsection