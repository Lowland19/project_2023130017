@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="container">
            <h1 class="text-center mb-3 fw-bolder" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                Daftar Buku Yang Dipinjam</h1>
            @if($pinjaman->isEmpty())
                {{-- Tampilan ini akan muncul jika TIDAK ADA buku yang dipinjam --}}
                <div class="text-center py-5 bg-light rounded-3 shadow-sm border">
                    <div class="mb-3">
                        {{-- Anda bisa menambahkan icon atau gambar di sini --}}
                        <h1 style="font-size: 4rem;">📚</h1>
                    </div>
                    <h3 class="fw-bold text-dark">Daftar Pinjaman Kosong</h3>
                    <p class="text-muted">Saat ini Anda tidak memiliki tanggungan peminjaman buku.</p>
                    <a href="{{ route('buku.index') }}" class="btn btn-primary px-4 py-2 mt-2 shadow-sm">
                        Cari Buku untuk Dipinjam
                    </a>
                </div>
            @else
                {{-- Tampilan Tabel hanya akan muncul jika ADA data --}}
                <div class="table-responsive rounded-3 mb-3">
                    <table class="table table-hover m-0" style="--bs-table-bg: #FFEDB8;">
                        <thead>
                            <tr class="border-bottom" style="--bs-border-color: #A37A00; --bs-border-width: 3px ">
                                <th>Judul Buku</th>
                                <th>Durasi Pinjam</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pinjaman as $data)
                                <tr>
                                    <td>{{ $data->buku->namaBuku }}</td>
                                    <td>{{ $data->durasiPinjam }} hari</td>
                                    <td>{{ \Carbon\Carbon::parse($data->tanggalAwalPinjam)->format('d-m-Y') }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('pengembalian.store') }}">
                                            @csrf
                                            <input type="hidden" name="idPinjaman" value="{{ $data->idPinjaman }}">
                                            <button class="btn btn-primary">Kembalikan</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
@endsection