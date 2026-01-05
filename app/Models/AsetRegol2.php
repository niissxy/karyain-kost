<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsetRegol2 extends Model
{
    protected $table = 'aset_kost_regol2';

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
