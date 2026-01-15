<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LapTransaksiCibiru2 extends Model
{
    protected $table = 'lap_transaksi_cibiru2';
    protected $fillable = [
        'id_laptransaksi',
        'id_transaksi',
        'nama_penghuni', 
        'no_kamar', 
        'nominal',
        'metode_pembayaran', 
        'tgl_pembayaran',
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
