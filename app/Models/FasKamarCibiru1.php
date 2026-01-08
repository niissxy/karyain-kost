<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FasKamarCibiru1 extends Model
{
    protected $table = 'fasilitas_kamar_cibiru1';

    protected $fillable = [
        'id_fask',
        'nama_fasilitas',
        'no_kamar',
        'kondisi',
        'user_id',
        'created_at',
        'updated_at'
    ];

    
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
