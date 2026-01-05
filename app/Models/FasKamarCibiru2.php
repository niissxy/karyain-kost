<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FasKamarCibiru2 extends Model
{
    protected $table = 'fasilitas_kamar_cibiru2';

    protected $fillable = [
        'id_fask',
        'nama_fasilitas',
        'no_kamar',
        'kondisi',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
