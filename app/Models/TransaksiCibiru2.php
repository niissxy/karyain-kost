<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiCibiru2 extends Model
{
    protected $table = 'transaksi_cibiru2';

    protected $fillable = [
        'id_transaksi',
        'nama_penyewa',
        'total_penyewa',
        'durasi_sewa',
        'no_kamar',
        'total_harga',
        'total_bayar',
        'tgl_pembayaran',
        'status',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
