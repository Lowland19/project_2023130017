@extends('layouts.app')

@section('content')
    @php
        // Jika ada session 'active_tab', gunakan itu. Jika tidak, default ke 'dashboard'
        $activeTab = request('tab') ?? session('active_tab') ?? 'dashboard-panel';
    @endphp
    <div class="container-fluid">
        <div class="container mb-3">
            <ul class="nav nav-tabs flex-nowrap" role="tablist" style="white-space: nowrap;">
                @can('lihatdashboardadmin')
                    <button class="nav-link {{ $activeTab == 'dashboard-panel' ? 'show active' : '' }}"
                        data-bs-target="#dashboard-panel" data-bs-toggle="tab">Dashboard</button>
                    @can('ubahpenggunaadmin')
                        <button class="nav-link {{ $activeTab == 'user-list' ? 'show active' : '' }}" data-bs-target="#user-list"
                            data-bs-toggle="tab">Daftar Pengguna</button>
                    @endcan
                    @can('registrasipengguna')
                        <button class="nav-link {{ $activeTab == 'user-registration' ? 'show active' : '' }}"
                            data-bs-target="#user-registration" data-bs-toggle="tab">Registrasi
                            Pengguna</button>
                    @endcan
                    @can('ubahbuku')
                        <button class="nav-link {{ $activeTab == 'daftar-buku-admin' ? 'show active' : '' }}"
                            data-bs-target="#daftar-buku-admin" data-bs-toggle="tab">Daftar Buku</button>
                    @endcan
                    @can('ubahperizinan')
                        <button class="nav-link {{ $activeTab == 'perizinan' ? 'show active' : '' }}" data-bs-target="#perizinan"
                            data-bs-toggle="tab">Perizinan</button>
                    @endcan
                    @can('verifikasibayar')
                        <button class="nav-link {{ $activeTab == 'verifikasi-pembayaran' ? 'show active' : '' }}"
                            data-bs-target="#verifikasi-pembayaran" data-bs-toggle="tab">Verifikasi Pembayaran</button>
                    @endcan
                @endcan
            </ul>
            <div class="tab-content mt-3">
                <div class="tab-pane fade {{ $activeTab == 'dashboard-panel' ? 'show active' : '' }}" id="dashboard-panel"
                    role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard Perpustakaan</h1>

                        <a href="{{ route('admin.export') }}" class="btn btn-sm btn-success shadow-sm">
                            <i class="bi bi-download me-1"></i> Generate Report
                        </a>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="border p-3 rounded-4" style="background-color: #FFEDB8;">
                                <p class="fw-bolder m-0">Jumlah Pengguna Layanan:</p>
                                <p class="m-0">{{ $totalPengguna }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border p-3 rounded-4" style="background-color: #FFEDB8;">
                                <p class="fw-bolder m-0">Jumlah Peminjam Hari Ini:</p>
                                <p class="m-0">{{ $peminjamHariIni }}</p>
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
                <div class="tab-pane fade {{ $activeTab == 'user-list' ? 'show active' : '' }}" id="user-list">
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
                                        <td>{{ $users->id }}</td>
                                        <td>{{ $users->name }}</td>
                                        <td>{{ $users->email }}</td>

                                        {{-- Buka Form di awal kolom Hak Akses atau Aksi --}}
                                        <form action="{{ route('admin.users.updateRole', $users->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <td>
                                                {{-- Dropdown Pilihan Role --}}
                                                <select name="role" class="form-select form-select-sm"
                                                    style="background-color: #fffbe6; border-color: #A37A00;">
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->name }}" {{ $users->hasRole($role->name) ? 'selected' : '' }}>
                                                            {{ ucfirst($role->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td>{{ $users->alamat }}</td>
                                            <td>{{ $users->nomortelepon }}</td>

                                            <td>
                                                {{-- Tombol Simpan di kolom Aksi --}}
                                                <button type="submit" class="btn btn-sm btn-primary shadow-sm">
                                                    <i class="fas fa-save"></i> Update
                                                </button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade {{ $activeTab == 'user-registration' ? 'show active' : '' }}"
                    id="user-registration">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="card border-0 shadow-lg my-4" style="border-radius: 15px;">

                                <div class="card-header bg-white border-0 pt-4 pb-0 text-center">
                                    <h4 class="font-weight-bold" style="color: #A37A00;">
                                        <i class="fas fa-user-plus me-2"></i> Form Registrasi Anggota Baru
                                    </h4>
                                    <p class="text-muted small">Lengkapi data di bawah ini untuk menambahkan pengguna baru.
                                    </p>
                                    <hr style="border-top: 2px solid #FFEDB8; width: 50%; margin: 10px auto;">
                                </div>

                                <div class="card-body p-5">
                                    <form action="{{ route('admin.store') }}" method="POST">
                                        @csrf

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold text-secondary small">Nama Lengkap</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light border-end-0"><i
                                                            class="fas fa-user text-muted"></i></span>
                                                    <input type="text" name="name"
                                                        class="form-control bg-light border-start-0"
                                                        placeholder="Contoh: Budi Santoso" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold text-secondary small">Alamat Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light border-end-0"><i
                                                            class="fas fa-envelope text-muted"></i></span>
                                                    <input type="email" name="email"
                                                        class="form-control bg-light border-start-0"
                                                        placeholder="nama@email.com" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold text-secondary small">Password</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light border-end-0"><i
                                                            class="fas fa-lock text-muted"></i></span>
                                                    <input type="password" name="password"
                                                        class="form-control bg-light border-start-0"
                                                        placeholder="Minimal 8 karakter" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold text-secondary small">Nomor Telepon</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light border-end-0"><i
                                                            class="fas fa-phone text-muted"></i></span>
                                                    <input type="number" name="nomortelepon"
                                                        class="form-control bg-light border-start-0" placeholder="0812..."
                                                        required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold text-secondary small">Alamat Lengkap</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i
                                                        class="fas fa-map-marker-alt text-muted"></i></span>
                                                <textarea name="alamat" class="form-control bg-light border-start-0"
                                                    rows="2" placeholder="Masukkan alamat domisili..." required></textarea>
                                            </div>
                                        </div>

                                        <div class="row align-items-end">
                                            <div class="col-md-6 mb-3 mb-md-0">
                                                <label class="form-label fw-bold text-secondary small">Hak Akses
                                                    (Role)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light border-end-0"><i
                                                            class="fas fa-user-tag text-muted"></i></span>
                                                    <select name="role" class="form-select bg-light border-start-0"
                                                        required>
                                                        <option value="" disabled selected>Pilih Role...</option>
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm"
                                                    style="background-color: #A37A00; border: none;">
                                                    <i class="fas fa-paper-plane me-2"></i> Daftarkan Pengguna
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade {{ $activeTab == 'daftar-buku-admin' ? 'show active' : '' }}"
                    id="daftar-buku-admin">
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
                                        @if($Buku->statusTersedia == 1)
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
                                                        <button class="btn btn-warning dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Pilih Aksi
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        
                                                            @can('ubahbuku')
                                                                <li><a class="dropdown-item" href="{{route('buku.edit', Crypt::encrypt($Buku->id))}}"><i
                                                                            class="bi bi-pencil-square me-2"></i>Edit</a></li>
                                                            @endcan
                                                            <li><a class="dropdown-item" href="#"><i
                                                                        class="bi bi-trash-fill me-2"></i>Hapus</a></li>
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
                            <a href="{{route('buku.create')}}" class="btn btn-primary mb-3 ms-5 justify-content-end me-2"><i
                                    class="bi bi-plus me-2"></i>Tambah Buku</a>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade {{ $activeTab == 'perizinan' ? 'show active' : '' }}" id="perizinan">
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
                                            <a href="{{ route('role.edit', Crypt::encrypt($r->id)) }}" class="btn btn-primary">Ubah Role</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade {{ $activeTab == 'verifikasi-pembayaran' ? 'show active' : '' }}"
                    id="verifikasi-pembayaran" role="tabpanel">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Permintaan Verifikasi Pembayaran</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Peminjam</th>
                                            <th>Buku</th>
                                            <th>Total Denda</th>
                                            <th>Bukti Transfer</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Loop data yang statusnya 'menunggu_verifikasi' --}}
                                        {{-- Pastikan Anda mengirim variabel $pendingPayments dari controller --}}
                                        @forelse($pendingPayments as $item)
                                            <tr>
                                                <td>{{ $item->peminjaman->user->name ?? 'User dihapus' }}</td>
                                                <td>{{ $item->peminjaman->buku->namaBuku ?? '-' }}</td>
                                                <td class="text-danger fw-bold">Rp {{ number_format($item->denda) }}</td>

                                                {{-- Tombol Lihat Bukti --}}
                                                <td>
                                                    @if($item->bukti_transfer)
                                                        <a href="{{ asset('bukti_bayar/' . $item->bukti_transfer) }}"
                                                            target="_blank" class="btn btn-sm btn-info">
                                                            <i class="fas fa-image"></i> Lihat Bukti
                                                        </a>
                                                    @else
                                                        <span class="text-muted">Tidak ada gambar</span>
                                                    @endif
                                                </td>

                                                {{-- Tombol Aksi --}}
                                                <td>
                                                    <form action="{{ route('admin.verifikasi_pembayaran', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            onclick="return confirm('Yakin ingin menyetujui pembayaran ini?')">
                                                            <i class="fas fa-check"></i> Setujui Lunas
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada pembayaran yang perlu
                                                    diverifikasi.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                data: [{{$bukuTersedia}}, {{ $bukuDipinjam }}], // contoh data
                backgroundColor: [
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 99, 132, 0.7)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 2
            }]
        };

        const dataDenda = {
            labels: ['Sudah dibayar', 'Belum dibayar'],
            datasets: [{
                label: 'Status Pembayaran Denda',
                data: [{{ $lunas }}, {{$belumLunas}}], // contoh data
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
            labels: [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ],
            datasets: [{
                label: "Jumlah Peminjaman",
                backgroundColor: "rgba(45, 254, 3, 1)", // Warna background arsiran (sesuai tema emas)
                borderColor: "rgba(0, 0, 0, 1)",       // Warna garis

                // BAGIAN PENTING: Masukkan data dari Laravel di sini
                data: @json($peminjamanPerBulan),
            }],
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