<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LapTransaksiRegol2 extends Model
{
    protected $table = 'lap_transaksi_regol2';
    protected $fillable = [
        'id_transaksi',
        'nama_penghuni', 
        'no_kamar', 
        'nominal', 
        'status_pembayaran',
        'user_id',
        'created_at',
        'updated_at'
    ];

    
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
