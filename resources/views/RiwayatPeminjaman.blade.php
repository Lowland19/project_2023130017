@extends('layouts.app')

@section('content')
    <h2 class="text-center fw-bolder mb-3" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        Riwayat Peminjaman
    </h2>

    {{-- PERBAIKAN 1: Alert Dinamis --}}
    {{-- Hanya muncul jika ada setidaknya satu data yang punya denda > 0 DAN belum dibayar --}}
    @if($pengembalian->where('denda', '>', 0)->where('sudahDibayar', 0)->count() > 0)
        <div class="alert alert-warning mb-3 ms-5 me-5 shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Perhatian!</strong> Ada denda keterlambatan yang belum Anda lunasi. Silakan cek tabel di bawah.
        </div>
    @endif

    <div class="table-responsive mb-3 me-5 ms-5 rounded-3 shadow-sm">
        <table class="table align-middle m-0" style="--bs-table-bg: #FFEDB8;">
            <thead>
                <tr class="border-bottom" style="--bs-border-color: #A37A00; --bs-border-width: 3px ">
                    <th>Judul Buku</th>
                    <th>Status</th>
                    <th>Tanggal Pinjam</th>
                    <th>Lama</th>
                    <th>Batas Kembali</th>
                    <th>Tanggal Kembali</th>
                    <th>Telat (Hari)</th>
                    <th>Denda</th>
                    <th>Aksi Pembayaran</th> {{-- Judul kolom diperjelas --}}
                </tr>
            </thead>
            <tbody>
                @forelse ($pengembalian as $p)
                    <tr>
                        {{-- Menggunakan null safe operator --}}
                        <td>{{ $p->peminjaman->buku->namaBuku ?? 'Buku dihapus' }}</td>

                        <td>
                            <span class="badge bg-secondary">{{ ucfirst($p->status) }}</span>
                        </td>

                        <td>{{ date('d-m-Y', strtotime($p->peminjaman->tanggalAwalPinjam)) }}</td>
                        <td>{{ $p->peminjaman->durasiPinjam }} Hari</td>
                        <td>{{ date('d-m-Y', strtotime($p->peminjaman->tanggalPengembalian)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($p->tanggalPengembalian)) }}</td>

                        <td class="text-center">
                            @if($p->totalKeterlambatan > 0)
                                <span class="text-danger fw-bold">{{ $p->totalKeterlambatan }}</span>
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            @if($p->denda > 0)
                                Rp {{ number_format($p->denda, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            @if($p->denda > 0)
                                {{-- Prioritas 1: Cek jika sudah lunas --}}
                                @if($p->status_pembayaran == 'lunas' || $p->sudahDibayar == 1)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i> Lunas
                                    </span>

                                    {{-- Prioritas 2: Cek jika sedang menunggu verifikasi (INI YANG KURANG) --}}
                                @elseif($p->status_pembayaran == 'menunggu_verifikasi')
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-clock me-1"></i> Menunggu Verifikasi
                                    </span>

                                    {{-- Prioritas 3: Jika belum bayar dan belum upload --}}
                                @else
                                    <button type="button" class="btn btn-sm btn-danger shadow-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalBayar{{ $p->id }}">
                                        <i class="fas fa-wallet me-1"></i> Bayar
                                    </button>

                                    @include('components.modal-bayar', ['item' => $p])
                                @endif
                            @else
                                <span class="badge bg-light text-muted border">Tidak Ada Denda</span>
                            @endif
                        </td>
                    </tr> {{-- PERBAIKAN 2: Penutup TR harus di DALAM loop --}}
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4">Belum ada riwayat pengembalian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PERBAIKAN 3: Tombol "Lakukan Pembayaran" di bawah dihapus karena tidak spesifik --}}

@endsection