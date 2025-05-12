<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    protected $table = 'tbl_balita';
    protected $primaryKey = 'balita_id';
    public $incrementing = true;

    protected $fillable = [
        'nama_balita',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'nama_orangtua',
    ];
}
