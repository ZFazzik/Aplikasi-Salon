<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    protected $table = 'tbl_info_web';
    protected $fillable = [
        'id','nama_web','icon_web','loginscreen_web','alamat','sosmed','cabang'
    ];
}
