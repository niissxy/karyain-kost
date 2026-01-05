<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LapKamarCibiru1 extends Model
{
    protected $table = 'lap_kamar_cibiru1';
    protected $fillable = [
        'id_kamar',
        'no_kamar', 
        'tipe_kamar', 
        'harga', 
        'status_kamar',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
