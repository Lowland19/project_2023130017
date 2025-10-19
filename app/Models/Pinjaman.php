<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'idBuku',
        'idPeminjam',
        'durasiPinjam',
        'tanggalAwalPinjam',
        'tanggalPengembalian'
    ];

    protected $table = 'pinjaman';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function buku(){
        return $this->hasOne(Buku::class,'id','idBuku');
    }
}
