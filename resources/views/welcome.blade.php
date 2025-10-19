@extends('layouts.app')

@section('content')

<div class="d-flex align-items-center justify-content-center mt-0 mb-3" style="height: 700px; background-color: #ffeead; background-image: url('https://jelajahjawa.fypmedia.id/uploads/artikels/fW2mTb6PLgLw2jpO7eLAPl1iiWFSnzKsQT3orqEu.jpg');
  background-size: cover;
  background-position: center;">
    <h1 class="m-5 text-white bg-dark" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Selamat Datang di Perpustakaan Digital</h1>
</div>
<div class="row">
    <div class="col-6">
        <div class="card">
            <img src="https://images.pexels.com/photos/978038/pexels-photo-978038.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
        </div>
    </div>
    <div class="col-6">
        <div class="card h-100 flex-fill shadow-sm d-flex flex-column">
            <div class="card-body d-flex flex-column">
                <h1 class="card-title text-center mb-3 mt-3" style="font-size: xxl;">Selamat Datang di Perpustakaan Digital</h1>
                <p class="card-text m-5 h-100 fw-bold" style="font-size: medium;">
                    Temukan, baca, dan pinjam berbagai koleksi buku favorit Anda kapan saja, di mana saja.
                </p>
                <div class="text-center">
                    <a href="#" class="btn btn-primary mt-auto" href="{{route('buku.index')}}">Lihat daftar Buku</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection