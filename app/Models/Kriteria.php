<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'tbl_kriteria';
    protected $primaryKey = 'kriteria_id';
    public $incrementing = true;

    public $fillable = [
        'kriteria_nama',
        'kriteria_atribut',
        'kriteria_bobot',
        'kriteria_bobot_normalisasi',
    ];
}
