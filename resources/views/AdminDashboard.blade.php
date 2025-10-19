@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container mb-3">
        <ul class="nav nav-tabs flex-nowrap" role="tablist" style="white-space: nowrap;">
            <button class="nav-link active" data-bs-target="#dashboard-panel" data-bs-toggle="tab">Dashboard</button>
            <button class="nav-link" data-bs-target="#user-list" data-bs-toggle="tab">Daftar Pengguna</button>
            <button class="nav-link" data-bs-target="#user-registration" data-bs-toggle="tab">Registrasi Pengguna</button>
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
                                <th>Status Akun</th>
                                <th>Tanggal Daftar</th>
                                <th>Terakhir Login</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $users = [
                            [
                            'id' => 1,
                            'nama' => 'Nickolas Darmawan',
                            'email' => 'nickolas.darmawan11@gmail.com',
                            'role' => 'Admin',
                            'status' => 'Aktif',
                            'tanggal_daftar' => '2025-02-01',
                            'terakhir_login' => '2025-10-15 09:42'
                            ],
                            [
                            'id' => 2,
                            'nama' => 'Budi Santoso',
                            'email' => 'budi.santoso@example.com',
                            'role' => 'Admin',
                            'status' => 'Aktif',
                            'tanggal_daftar' => '2025-02-01',
                            'terakhir_login' => '2025-10-15 09:42'
                            ],
                            [
                            'id' => 3,
                            'nama' => 'Siti Rahmawati',
                            'email' => 'siti.rahmawati@example.com',
                            'role' => 'Petugas',
                            'status' => 'Aktif',
                            'tanggal_daftar' => '2025-04-20',
                            'terakhir_login' => '2025-10-14 15:10'
                            ],
                            [
                            'id' => 4,
                            'nama' => 'Andi Pratama',
                            'email' => 'andi.pratama@example.com',
                            'role' => 'Member',
                            'status' => 'Nonaktif',
                            'tanggal_daftar' => '2025-07-05',
                            'terakhir_login' => '2025-08-10 11:20'
                            ],
                            [
                            'id' => 5,
                            'nama' => 'Dewi Lestari',
                            'email' => 'dewi.lestari@example.com',
                            'role' => 'Member',
                            'status' => 'Aktif',
                            'tanggal_daftar' => '2025-09-10',
                            'terakhir_login' => '2025-10-16 07:35'
                            ],
                            ];
                            @endphp

                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user['id'] }}</td>
                                <td>{{ $user['nama'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>
                                    <span class="badge 
              @if($user['role'] === 'Admin') bg-danger 
              @elseif($user['role'] === 'Petugas') bg-primary 
              @else bg-secondary @endif">
                                        {{ $user['role'] }}
                                    </span>
                                </td>
                                <td>
                                    @if($user['status'] === 'Aktif')
                                    <span class="badge bg-success">Aktif</span>
                                    @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($user['tanggal_daftar'])->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($user['terakhir_login'])->format('d M Y H:i') }}</td>
                                <td>
                                    <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Pilih Aksi
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="user-registration">
                <div class="mb-3">
                    <label for="nama" class="form-label fw-bolder mb-0">Nama Pengguna</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bolder mb-0">Email Pengguna</label>
                    <input type="text" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="Password" class="form-label fw-bolder mb-0">Password</label>
                    <input type="text" name="Password" id="Password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success fw-bolder mb-0">Daftarkan Pengguna</button>
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