<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'tbl_penjualan';
    protected $fillable = [
        'id','nama_barang','img','jenis','supplier','modal','harga_satuan','jumlah','total_harga','laba','nama_pegawai','deskripsi'
    ];
}
