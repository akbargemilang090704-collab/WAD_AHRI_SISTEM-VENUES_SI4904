<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alat';
    public $timestamps = false;

    protected $fillable = ['kode', 'nama', 'kategori', 'kondisi', 'stok', 'tarif_sewa'];

    protected $casts = ['stok' => 'integer', 'tarif_sewa' => 'decimal:2'];
}
