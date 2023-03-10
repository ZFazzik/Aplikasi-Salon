<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'tbl_penjualan';
    protected $fillable = [
        'id','id_barang','jumlah','total_harga','laba','id_pegawai','deskripsi'
    ];
}
