@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2>Daftar Buku</h2>
    @guest
    <h3>Jika ingin melakukan peminjaman anda harus login terlebih dahulu</h3>
    @endguest
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Status Tersedia</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($buku as $Buku)
            <tr>
                <td>{{$Buku -> id}}</td>
                <td>{{$Buku -> namaBuku}}</td>
                <td>{{$Buku -> penulis}}</td>
                <td>{{$Buku -> penerbit}}</td>
                <td>@if($Buku -> statusTersedia == 1)
                        <p>Tersedia</p>
                    @else
                        <p>Tidak Tersedia</p>
                    @endif
                </td>
                <td>
                    @auth
                    <a href="#" class="btn btn-primary">Pinjam</a>
                    <a href="{{ route('buku.edit', $Buku->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{route('buku.destroy',$Buku->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau hapus buku ini?')">Hapus</button>
                    </form>
                    @endauth
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{route('buku.create')}}" class="btn btn-primary mb-3">Tambah Buku</a>
</div>
@endsection