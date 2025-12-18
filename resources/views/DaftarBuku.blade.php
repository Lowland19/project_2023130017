@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center fw-bolder" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Daftar Buku</h1>
    @guest
    <div class="alert alert-primary d-inline-block p-2" role="alert">
        <p class="text-center m-0">Jika ingin melakukan peminjaman anda harus login terlebih dahulu</p>
    </div>
    @endguest
    <ul class="nav nav-pills flex-nowrap justify-content-end" role="tablist" style="white-space: nowrap;">
        <button class="nav-link active" data-bs-target="#tabel" id="tabeltab" data-bs-toggle="tab"><i class="bi bi-table"></i></button>
        <button class="nav-link" data-bs-target="#card" id="cardtab" data-bs-toggle="tab"><i class="bi bi-file"></i></button>
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
                            <td>{{$Buku -> id}}</td>
                            <td>{{$Buku -> namaBuku}}</td>
                            <td>{{$Buku -> penulis}}</td>
                            <td>{{$Buku -> penerbit}}</td>
                            <td>{{ $Buku -> tahun_terbit }}</td>
                            <td>{{ $Buku -> kategori }}</td>
                            <td>{{ $Buku -> isbn }}</td>
                            @if($Buku -> statusTersedia == 1)
                            <td class="table-success" style="border-color: #A37A00; ">
                                <p>Tersedia</p>
                            </td>
                            @else
                            <td class="table-danger" style="border-color: #A37A00; ">
                                <p>Tidak Tersedia</p>
                            </td>
                            @endif
                            <td>
                                <div class="d-inline-flex gap-2 justify-content-end">
                                    @auth

                                    <a class="btn btn-warning" type="button" href="{{ route('buku.pinjam',$Buku->id) }}">
                                        Pinjam Buku
                                    </a>
                                    @endauth
                                </div>

                            </td>
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
                        <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIAJQAoQMBIgACEQEDEQH/xAAaAAEBAQEBAQEAAAAAAAAAAAAAAQMCBAUH/8QALhABAAEBBAkEAgIDAAAAAAAAAAECAxQycgUREzEzQlFSoQQSgbEjkWJxISJB/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/EABQRAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhEDEQA/AP3EAAAAZeotdjZVV6ter/jO9TriPZvjWD0jz3ie3yseont8g3GG3nt8m3nt8g3GG3npH7NvPSP2DcY7aehtp6A2GO2notFpNVURqBqAAAAAAAAAD5elLSf8Uxu90O4xU5WWk8cZoa81OUHSwigoQAoAKACw7sscOHdljgG4AAAAAAAAAPk6Ux05oac1OVlpPHTmhrzU5QdQqKCwqLAKIsAKigO7LiQ4d2XEgHoAAAAAAAAAB8jSeOnNDXmpystJ46c0NOanKDtXKgqoA6VzEugBFAd2XEhw7seJAPSAAAAAAAAAD4+k8dOaGsY4ystJ46c0NYxxlB0qAOhFBViXKgokSoK7seJDNpY8SAekAAAAAAAAAHxtJz+SnNH215oystJ8SnNH201/7R/QO4VysSCqgDoRQFQB1rd2PEp+WTSwn8tIPWAAAAAAAAAD4uk8dOaPtrzRlY6Sx05o+2vNGUHYigsSrldYKqAKrlQV3YcWlm0sONSD2AAAAAAAAE7hKt0g+LpHiU5oa88ZWOkZ/JTH8oac8ZQaCQA6EAWHWtwoOhNZEgrT0/Gp+fpm09Pxqfn6B7QAAAAAAAEq3SoD4mkLKfdFfSYlzebGascbuj6ltYxXDyXCNe4GEepsu+P0t5su7w9EehjotyjoDzXmy7/C3my7/D03GntLjT0B5rxZd/hbxY9/h6blT0LlT0B5rzZd/iS82Xd4l6rjT0LjHQHmpt7OrDVr+Jer01NW1pn2zq6/Duz9JTTO56aafbAKAAAAAAAAAAigIoAIoCKAAAAAAAAAAAP/2Q==" class="card-image-top">
                        <div class="card-body d-flex flex-column">
                            <div class="mb-3">
                                <h5 class="card-title fw-bolder">{{$Buku->namaBuku}}</h5>
                            </div>
                            <div class="mb-3">
                                <p class="card-text m-0 p-0">Penulis: {{$Buku->penulis}}</p>
                                <p class="card-text m-0 p-0">Penerbit: {{$Buku->penerbit}}</p>
                                <p class="card-text m-0 p-0">Tahun Terbit: {{$Buku->tahun_terbit}}</p>
                                <p class="card-text m-0 p-0">Kategori: {{$Buku->kategori}}</p>
                                <p class="card-text m-0 p-0">ISBN: {{$Buku->isbn}}</p>
                                <p class="card-text m-0 p-0">Status: @if($Buku -> statusTersedia == 1)
                                    Tersedia <i class="bi bi-check-square"></i></i>
                                    @else
                                    Tidak Tersedia <i class="bi bi-x-square"></i>
                                    @endif</p>
                            </div>

                            <button class="btn btn-warning" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Pinjam Buku
                            </button>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>

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

    window.addEventListener('resize', function() {
        if (window.innerWidth < 768) {
            document.querySelector('#cardtab').click();
        } else {
            document.querySelector('#tabletab').click();
        }
    });
</script>

@endsection