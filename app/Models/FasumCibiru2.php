<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FasumCibiru2 extends Model
{
    protected $table = 'fasilitas_umum_cibiru2';

    protected $fillable = [
        'id_fasum',
        'nama_fasilitas',
        'kondisi',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
