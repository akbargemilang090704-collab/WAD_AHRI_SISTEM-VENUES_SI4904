<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    protected $table = 'lapngans';

    protected $fillable = [
        'nama_lapangan',
        'jenis',
        'harga',
        'deskripsi'
    ];
}
