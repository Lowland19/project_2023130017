<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Pinjaman;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index(){
        $userId = Auth::id();

        $pengembalian = Pengembalian::with(['peminjaman.buku'])->whereHas('peminjaman', function($query) use ($userId){$query->where('idPeminjam',$userId);})->get();
        return view('RiwayatPeminjaman',compact('pengembalian'));
    }

    public function store(Request $request){
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
        'idPinjaman'          => $peminjaman->idPinjaman,
        'tanggalPengembalian' => $tanggalKembaliSekarang,
        'totalKeterlambatan'  => $totalKeterlambatan,
        'denda'               => $totalDenda,
        'sudahDibayar'        => $sudahDibayar,
        'status'              => 'Dikembalikan', // Status text tambahan
    ]);
    $peminjaman->buku->update(['statusTersedia' => 1]);
    }
}
