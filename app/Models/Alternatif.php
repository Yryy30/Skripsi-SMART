<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $table = 'tbl_alternatif';
    protected $primaryKey = 'alternatif_id';
    public $incrementing = true;

    protected $fillable = [
        'balita_id',
        'tanggal_pengukuran',
        'umur_bulan',
        'tb',
        'bb',
        'tb_zscore',
        'bb_zscore',
        'asi',
        'mpasi',
        'sanitasi',
    ];

    public function balita()
    {
        return $this->belongsTo(Balita::class, 'balita_id', 'balita_id');
    }
}
