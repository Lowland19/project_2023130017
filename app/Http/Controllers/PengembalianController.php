<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Pinjaman;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = Pengembalian::all();
        $userId = Auth::id();


        $pengembalian = Pengembalian::with(['peminjaman.buku'])->whereHas('peminjaman', function ($query) use ($userId) {
            $query->where('idPeminjam', $userId);
        })->get();
        return view('RiwayatPeminjaman', compact('pengembalian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idPinjaman' => 'required|exists:pinjaman,idPinjaman'
        ]);
        $peminjaman = Pinjaman::where('idPinjaman', $request->idPinjaman)->firstOrFail();
        $tanggalWajibKembali = Carbon::parse($peminjaman->tanggalPengembalian);
        $tanggalKembaliSekarang = Carbon::now();

        $totalKeterlambatan = 0;

        if ($tanggalKembaliSekarang->gt($tanggalWajibKembali)) {
            $totalKeterlambatan = $tanggalKembaliSekarang->diffInDays($tanggalWajibKembali);
        }

        $dendaPerHari = 1000;
        $totalDenda = $totalKeterlambatan * $dendaPerHari;
        $sudahDibayar = ($totalDenda == 0) ? 1 : 0;

        Pengembalian::create([
            'idPeminjaman' => $peminjaman->idPinjaman,
            'tanggalPengembalian' => $tanggalKembaliSekarang,
            'totalKeterlambatan' => $totalKeterlambatan,
            'denda' => $totalDenda,
            'sudahDibayar' => $sudahDibayar,
            'status' => 'Dikembalikan', // Status text tambahan
        ]);
        $peminjaman->buku->update(['statusTersedia' => 1]);
        return redirect()->route('pengembalian.index')->with('success', 'Buku Berhasil Dikembalikan!');
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pengembalian = Pengembalian::findOrFail($id);

        // 1. Simpan File Gambar ke folder 'public/bukti_bayar'
        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('bukti_bayar'), $filename);

            // Simpan nama file ke database
            $pengembalian->bukti_transfer = $filename;
        }

        // 2. Ubah status jadi 'menunggu_verifikasi'
        // Asumsi: Anda pakai kolom baru 'status_pembayaran', atau logika manual
        $pengembalian->status_pembayaran = 'menunggu_verifikasi';
        $pengembalian->save();

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload. Tunggu verifikasi admin.');
    }
}
