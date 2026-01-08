<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsetCibiru2 extends Model
{
    protected $table = 'aset_kost_cibiru2';

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

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
