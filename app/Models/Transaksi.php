<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'tbl_keranjang';
    protected $fillable = [
        'id','id_barang','nama_pegawai','jumlah','total','keterangan'
    ];
}
