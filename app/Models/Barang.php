<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'tbl_barang';
    protected $fillable = [
        'nama','img','jenis','supplier','modal','harga','jumlah','sisa','notif'
    ];
}
