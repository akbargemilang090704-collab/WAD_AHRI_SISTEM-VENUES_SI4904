<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    protected $table = 'lapangan';
    public $timestamps = false;

    protected $fillable = ['kode', 'nama', 'jenis_olahraga', 'jenis_permukaan', 'ukuran', 'status_fisik'];
}
