<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlatOlahraga extends Model
{
    protected $fillable = [
        'nama_alat',
        'kondisi',
        'tarif',
    ];
}
