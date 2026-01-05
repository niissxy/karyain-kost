<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LapTransaksiRegol1 extends Model
{
    protected $table = 'lap_transaksi_regol1';
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
}
