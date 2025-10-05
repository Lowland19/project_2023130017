<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'idBuku',
        'namaPeminjam',
        'durasiPinjam',
        'tanggalAwalPinjam',
        'tanggalPengembalian'
    ];

    protected $table = 'pinjaman';
}
