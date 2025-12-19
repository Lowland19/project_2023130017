@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center fw-bolder" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Daftar Buku
        </h1>
        @guest
            <div class="alert alert-primary d-inline-block p-2" role="alert">
                <p class="text-center m-0">Jika ingin melakukan peminjaman anda harus login terlebih dahulu</p>
            </div>
        @endguest
        <ul class="nav nav-pills flex-nowrap justify-content-end" role="tablist" style="white-space: nowrap;">
            <button class="nav-link active" data-bs-target="#tabel" id="tabeltab" data-bs-toggle="tab"><i
                    class="bi bi-table"></i></button>
            <button class="nav-link" data-bs-target="#card" id="cardtab" data-bs-toggle="tab"><i
                    class="bi bi-file"></i></button>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="tabel" role="tabpanel">
                <div class="table-responsive rounded-3 mb-3">
                    <table class="table table-hover align-middle m-0" style="--bs-table-bg: #FFEDB8;">
                        <thead>
                            <tr class="border-bottom" style="--bs-border-color: #A37A00; --bs-border-width: 3px ">
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>Kategori</th>
                                <th>ISBN</th>
                                <th>Status Tersedia</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($buku as $Buku)
                                <tr class="border-bottom" style="--bs-border-color: #A37A00;">
                                    <td>{{$Buku->id}}</td>
                                    <td>{{$Buku->namaBuku}}</td>
                                    <td>{{$Buku->penulis}}</td>
                                    <td>{{$Buku->penerbit}}</td>
                                    <td>{{ $Buku->tahun_terbit }}</td>
                                    <td>{{ $Buku->kategori }}</td>
                                    <td>{{ $Buku->isbn }}</td>

                                    {{-- KOLOM 8: Status Tersedia (Teks Saja) --}}
                                    <td>
                                        @if($Buku->statusTersedia == 1)
                                            <span class="badge bg-success">Tersedia</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Tersedia</span>
                                        @endif
                                    </td>

                                    {{-- KOLOM 9: Aksi (Tombol Logika) --}}
                                    @can('dapatmeminjam')
                                    <td>
                                        <div class="d-inline-flex gap-2 justify-content-end">
                                            @auth
                                                @if($Buku->statusTersedia == 1)
                                                    {{-- Jika Tersedia: Tombol Kuning Aktif --}}
                                                    <a href="{{ route('buku.pinjam', Crypt::encrypt($Buku->id)) }}"
                                                        class="btn btn-warning shadow-sm btn-sm">
                                                        <i class="bi bi-journal-plus me-1"></i> Pinjam
                                                    </a>
                                                @else
                                                    {{-- Jika Tidak Tersedia: Tombol Abu-abu Disabled --}}
                                                    <button type="button" class="btn btn-secondary btn-sm" disabled
                                                        style="cursor: not-allowed; opacity: 0.6;">
                                                        <i class="bi bi-x-circle me-1"></i> Tidak Tersedia
                                                    </button>
                                                @endif
                                            @else
                                                {{-- Jika Belum Login --}}
                                                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Login</a>
                                            @endauth
                                        </div>
                                    </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="card" role="tabpanel">
                <div class="row justify-content-center">
                    @foreach($buku as $Buku)
                        <div class="col-6 col-md-4 col-lg-3 mb-4 d-flex">

                            <div class="card h-100 flex-fill shadow-sm d-flex flex-column">
                                <img src="..." class="card-img-top" alt="Cover Buku" style="object-fit: cover; height: 250px;">

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bolder">{{$Buku->namaBuku}}</h5>

                                    <div class="mb-3 small">
                                        <p class="m-0">Penulis: {{$Buku->penulis}}</p>
                                        <p class="m-0">Status:
                                            @if($Buku->statusTersedia == 1)
                                                <span class="text-success fw-bold">Tersedia</span>
                                            @else
                                                <span class="text-danger fw-bold">Habis</span>
                                            @endif
                                        </p>
                                    </div>

                                    <div class="mt-auto">
                                        @if($Buku->statusTersedia == 1)
                                            <a href="{{ route('buku.pinjam', $Buku->id) }}"
                                                class="btn btn-warning w-100 shadow-sm">
                                                Pinjam Buku
                                            </a>
                                        @else
                                            <button class="btn btn-secondary w-100" disabled>Tidak Tersedia</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                    </div> @endforeach
                </div>
            </div>
        </div>
    </div>


    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     // Deteksi ukuran layar
        //     if (window.innerWidth < 768) { // < 768px = layar HP (Bootstrap breakpoint "md")
        //         // Ambil elemen tab Card
        //         const cardTab = document.querySelector('#cardtab');
        //         const cardPane = document.querySelector('#card');

        //         const tableTab = document.querySelector('#tabletab');
        //         const tablePane = document.querySelector('#table');

        //         // Nonaktifkan tab tabel
        //         tableTab.classList.remove('active');
        //         tablePane.classList.remove('show', 'active');

        //         // Aktifkan tab card
        //         cardTab.classList.add('active');
        //         cardPane.classList.add('show', 'active');
        //     }
        // });

        window.addEventListener('resize', function () {
            if (window.innerWidth < 768) {
                document.querySelector('#cardtab').click();
            } else {
                document.querySelector('#tabletab').click();
            }
        });
    </script>

@endsection