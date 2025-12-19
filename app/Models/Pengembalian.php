<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';

    protected $fillable = [
        'id',
        'idPeminjaman',
        'status',
        'tanggalPengembalian',
        'totalKeterlambatan',
        'denda',
        'sudahDibayar',
        'bukti_transfer',
        'status_pembayaran'
    ];

    protected $primaryKey = 'id';

    public function peminjaman()
    {
        return $this->belongsTo(Pinjaman::class, 'idPeminjaman', 'idPinjaman');
    }
}
