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
            <tr class="border-bottom" style="--bs-border-color: #A37A00;">
                <td>Diary Of A Wimpy Kids Rodrick Rules</td>
                <td>Sudah Dikembalikan</td>
                <td>25/08/2025</td>
                <td>7</td>
                <td>25/08/2025</td>
                <td>25/08/2025</td>
                <td>0</td>
                <td>0</td>
                <td>Tidak Perlu</td>
            </tr>
            <tr class="border-bottom" style="--bs-border-color: #A37A00;">
                <td>Rumah Beratap Bougenvil</td>
                <td>Sudah Dikembalikan</td>
                <td>01/09/2025</td>
                <td>7</td>
                <td>08/09/2025</td>
                <td>11/09/2025</td>
                <td>3</td>
                <td>15000</td>
                <td>Belum</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="btn btn-success ms-5" data-bs-target="pembayaran" data-bs-toggle="modal">Lakukan Pembayaran</div>


@endsection