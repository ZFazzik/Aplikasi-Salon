<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properti extends Model
{
    use HasFactory;
    protected $table = 'tbl_properti';
    protected $fillable = [
        'id','nama','type','keterangan'
    ];
}
