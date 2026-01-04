<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KamarCibiru1 extends Model
{
    protected $table = 'kamar_cibiru1';

    protected $fillable = [
        'id_kamar',
        'tipe_kamar', 
        'no_kamar', 
        'status_kamar', 
        'harga',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
