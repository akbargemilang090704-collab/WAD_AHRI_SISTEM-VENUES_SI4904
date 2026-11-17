<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instruktur extends Model
{
    protected $table = 'instruktur';
    public $timestamps = false;

    protected $fillable = ['nama', 'no_lisensi', 'keahlian', 'telepon', 'status'];
}
