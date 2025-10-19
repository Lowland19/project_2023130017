@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container">
        <h1 class="text-center fw-bolder mb-3" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Edit Buku</h1>
        <div class="container rounded-3 p-5" style="background-color: #FFEDB8;">
            <form action="{{route('buku.update', $buku->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="namaBuku" class="form-label fw-bolder mb-0">Judul Buku</label>
                    <input type="text" name="namaBuku" id="namaBuku" class="form-control" required value="{{$buku->namaBuku}}">
                </div>
                <div class="mb-3">
                    <label for="penulis" class="form-label fw-bolder mb-0">Penulis</label>
                    <input type="text" name="penulis" id="penulis" class="form-control" required value="{{$buku->penulis}}">
                </div>
                <div class="mb-3">
                    <label for="penerbit" class="form-label fw-bolder mb-0">Penerbit</label>
                    <input type="text" name="penerbit" id="penerbit" class="form-control" required value="{{$buku->penerbit}}">
                </div>
                <div class="mb-3">
                    <label for="statusTersedia" class="form-label fw-bolder mb-0">Status Tersedia</label>
                    <input type="hidden" name="statusTersedia" value="0">
                    <input type="checkbox" name="statusTersedia" id="statusTersedia" value="1" {{ $buku->statusTersedia ? 'checked' : '' }}>
                </div>
                <button type="submit" class="btn btn-success">Perbarui</button>
                <a href="{{route('buku.index')}}" class="btn btn-secondary"><i class="bi bi-arrow-return-left"> Kembali </i></a>
            </form>
        </div>
    </div>
</div>
@endsection