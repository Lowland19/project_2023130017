@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="container">
        <h1 class="text-center mb-3 fw-bolder" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Daftar Buku Yang Dipinjam</h1>
        <div class="table-responsive rounded-3 mb-3">
            <table class="table table-hover m-0" style="background-color:red; --bs-table-bg: #FFEDB8;">
                <thead>
                    <tr class="border-bottom" style="--bs-border-color: #A37A00; --bs-border-width: 3px ">
                        <th>Judul Buku</th>
                        <th>Durasi Pinjam</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @foreach($pinjaman as $data)
                <tr class="border-bottom" style="--bs-border-color: #A37A00;">
                    <td> {{$data->buku->namaBuku}}</td>
                    <td> {{$data->durasiPinjam }} hari</td>
                    <td> {{date('d/m/Y', strtotime($data->tanggalAwalPinjam))}}</td>
                    <td> {{date('d/m/Y', strtotime($data->tanggalPengembalian))}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('buku.pinjam', $data->buku->id) }}">Kembalikan</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection