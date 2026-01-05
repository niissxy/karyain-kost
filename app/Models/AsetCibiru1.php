<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsetCibiru1 extends Model
{
    protected $table = 'aset_kost_cibiru1';

    protected $fillable = [
        'id_aset',
        'nama_aset', 
        'kategori', 
        'jumlah', 
        'kondisi',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
