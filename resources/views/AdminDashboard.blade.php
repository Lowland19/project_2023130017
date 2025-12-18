@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container mb-3">
        <ul class="nav nav-tabs flex-nowrap" role="tablist" style="white-space: nowrap;">
            <button class="nav-link active" data-bs-target="#dashboard-panel" data-bs-toggle="tab">Dashboard</button>
            <button class="nav-link" data-bs-target="#user-list" data-bs-toggle="tab">Daftar Pengguna</button>
            <button class="nav-link" data-bs-target="#user-registration" data-bs-toggle="tab">Registrasi Pengguna</button>
            <button class="nav-link" data-bs-target="#daftar-buku-admin" data-bs-toggle="tab">Daftar Buku</button>
            <button class="nav-link" data-bs-target="#perizinan" data-bs-toggle="tab">Perizinan</button>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="dashboard-panel" role="tabpanel">
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="border p-3 rounded-4" style="background-color: #FFEDB8;">
                            <p class="fw-bolder m-0">Jumlah Pengguna Layanan:</p>
                            <p class="m-0">100</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border p-3 rounded-4" style="background-color: #FFEDB8;">
                            <p class="fw-bolder m-0">Jumlah Peminjam Hari Ini:</p>
                            <p class="m-0">11</p>
                        </div>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col-12 col-md-6">
                        <div class="border p-3 rounded-4" style="background-color: #FFEDB8;">
                            <div class="chart-container" style="position: relative; width: 100%; min-height: 200px;">
                                <canvas id="bukuChart" class="me-5 ms-5"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="border p-3 rounded-4" style="background-color: #FFEDB8;">
                            <div class="chart-container" style="position: relative; width: 100%; min-height: 200px;">
                                <canvas id="pinjamanChart" class="me-5 ms-5"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="border p-3 rounded-4" style="background-color: #FFEDB8;">
                            <div class="chart-container" style="position: relative; width: 100%; min-height: 200px;">
                                <canvas id="jumlahChart" class="me-5 ms-5"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="user-list">
                <div class="table-responsive">
                    <table class="table table-hover m-0" style="--bs-table-bg: #FFEDB8;">
                        <thead>
                            <tr class="border-bottom" style="--bs-border-color: #A37A00; --bs-border-width: 3px ">
                                <th>ID</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Hak Akses</th>
                                <th>Alamat</th>
                                <th>Nomor Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $users)
                            <tr>
                                <td>{{$users->id}}</td>
                                <td>{{$users->name}}</td>
                                <td>{{$users->email}}</td>
                                <td>{{$users->role}}</td>
                                <td>{{$users->alamat}}</td>
                                <td>{{$users->nomortelepon}}</td>
                                <td>Aksi</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="user-registration">
                <form method="POST" action="{{route('admin.store')}}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="name" class="form-label fw-bolder mb-0">Nama Pengguna</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="email" class="form-label fw-bolder mb-0">Email Pengguna</label>
                            <input type="text" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="password" class="form-label fw-bolder mb-0">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="alamat" class="form-label fw-bolder mb-0">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="nomortelepon" class="form-label fw-bolder mb-0">Nomor Telepon</label>
                            <input type="text" name="nomortelepon" id="nomortelepon" class="form-control" required>
                        </div>
                        <div class="col-3">
                            <label for="role" class="form-label fw-bolder mb-0">Role</label>
                            <select class="form-select" id="role" name="role">
                                <option selected disabled>Pilih role pengguna</option>
                                <option value="pengguna">Pengguna</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-success fw-bolder mb-0">Daftarkan Pengguna</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="daftar-buku-admin">
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

                                        <div class="dropdown">
                                            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                Pilih Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    @if($Buku -> statusTersedia == 1)
                                                    <a href="{{ route('buku.pinjam', $Buku->id) }}" class="btn btn-primary dropdown-item">Pinjam</a>
                                                    @else

                                                    @endif
                                                </li>
                                                <li><a class="dropdown-item" href="{{route('buku.edit',$Buku->id)}}"><i class="bi bi-pencil-square me-2"></i>Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-trash-fill me-2"></i>Hapus</a></li>
                                            </ul>
                                        </div>
                                        @endauth
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{route('buku.create')}}" class="btn btn-primary mb-3 ms-5 justify-content-end me-2"><i class="bi bi-plus me-2"></i>Tambah Buku</a>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="perizinan">
                <p>Test</p>
                <div class="table-responsive rounded-3 mb-3">
                    <table class="table table-hover align-middle m-0" style="--bs-table-bg: #FFEDB8;">
                        <thead class="border-bottom" style="--bs-border-color: #A37A00; --bs-border-width: 3px ">
                            <tr>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $r)
                            <tr>
                                <td>{{ $r->name }}</td>
                                <td>
                                    <a href="{{ route('role.edit',$r->id) }}" class="btn btn-primary">Ubah Role</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Contoh data — bisa kamu ganti dari controller
    const dataBuku = {
        labels: ['Tersedia', 'Dipinjam'],
        datasets: [{
            label: 'Status Buku',
            data: [12, 8], // contoh data
            backgroundColor: [
                'rgba(75, 192, 192, 0.7)', // hijau muda
                'rgba(255, 205, 86, 0.7)', // kuning
                'rgba(255, 99, 132, 0.7)' // merah
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 2
        }]
    };

    const dataDenda = {
        labels: ['Sudah dibayar', 'Belum dibayar'],
        datasets: [{
            label: 'Status Pembayaran Denda',
            data: [35, 12], // contoh data
            backgroundColor: [
                'rgba(75, 192, 192, 0.7)', // hijau muda
                'rgba(255, 99, 132, 0.7)' // merah
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 2
        }]
    };

    const dataJumlahPeminjaman = {
        labels: ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober'],
        datasets: [{
            label: 'Bulan',
            data: [12, 8, 3, 77, 24, 9, 48, 22, 69, 60], // contoh data
            backgroundColor: [
                'rgba(75, 192, 192, 0.7)', // hijau muda
                'rgba(75, 192, 192, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(75, 192, 192, 0.7)',

            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)',
            ],
            borderWidth: 2
        }]
    };

    const config = {
        type: 'pie',
        data: dataBuku,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Distribusi Status Buku'
                }
            }
        },
    };

    const tampilanJumlahPeminjam = {
        type: 'bar',
        data: dataJumlahPeminjaman,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Jumlah Peminjam per Bulan'
                }
            }
        },
    };

    const configPinjaman = {
        type: 'pie',
        data: dataDenda,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Status Pembayaran Denda'
                }
            }
        },
    };

    // Render chart ke <canvas>
    new Chart(
        document.getElementById('bukuChart'),
        config
    );

    new Chart(
        document.getElementById('pinjamanChart'),
        configPinjaman
    );

    new Chart(
        document.getElementById('jumlahChart'),
        tampilanJumlahPeminjam
    );
</script>
@endsection