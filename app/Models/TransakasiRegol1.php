<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransakasiRegol1 extends Model
{
    protected $table = 'transaksi_regol1';
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
