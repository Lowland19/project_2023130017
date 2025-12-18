@extends('layouts.app')

@section('content')
<h2 class="text-center fw-bolder mb-3" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Riwayat Peminjaman</h2>
<div class="alert alert-warning mb-3 ms-5 me-5" role="alert">
    Ada Denda yang belum dibayarkan!
</div>
<div class="table-responsive mb-3 me-5 ms-5 rounded-3">
    <table class="table align-middle m-0" style="--bs-table-bg: #FFEDB8;">
        <thead>
            <tr class="border-bottom" style="--bs-border-color: #A37A00; --bs-border-width: 3px ">
                <th>Judul Buku</th>
                <th>Status</th>
                <th>Tanggal Peminjaman</th>
                <th>Lama Peminjaman</th>
                <th>Batas Pengembalian</th>
                <th>Tanggal Pengembalian</th>
                <th>Total Keterlambatan</th>
                <th>Denda</th>
                <th>Sudah Dibayar?</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengembalian as $p)
            <tr>
                <td>{{ $p->peminjaman->buku->namaBuku ?? 'Buku tidak ditemukan'}}</td>
                <td>{{ $p->status }}</td>
                <td>{{ $p->peminjaman->tanggalAwalPinjam }}</td>
                <td>{{ $p->peminjaman->durasiPinjam }}</td>
                <td>{{ $p->peminjaman->tanggalPengembalian }}</td>
                <td>{{ $p->tanggalPengembalian }}</td>
                <td>{{ $p->totalKeterlambatan }}</td>
                <td>{{ $p->denda }}</td>
                @if($p -> Status == 1)
                <td class="table-success">
                    <p>Sudah dibayar</p>
                </td>
                @else
                <td class="table-danger">
                    <p>Belum dibayar</p>
                </td>
                @endif
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
<div class="btn btn-success ms-5" data-bs-target="pembayaran" data-bs-toggle="modal">Lakukan Pembayaran</div>
@endsection