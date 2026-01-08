<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KamarRegol1 extends Model
{
    protected $table = 'kamar_regol1';
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

    
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
