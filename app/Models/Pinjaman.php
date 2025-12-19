<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'idPeminjaman',
        'idBuku',
        'idPeminjam',
        'durasiPinjam',
        'tanggalAwalPinjam',
        'tanggalPengembalian'
    ];

    protected $table = 'pinjaman';

    protected $primaryKey = 'idPeminjaman';

    public function user(){
        return $this->belongsTo(User::class,'idPeminjam','id');
    }

    public function buku(){
        return $this->belongsTo(Buku::class, 'idBuku','id');
    }

    public function pengembalian(){
        return $this->hasOne(Pengembalian::class, 'idPeminjaman', 'idPinjaman');
    }    
}
