<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiRegol2 extends Model
{
    protected $primaryKey = 'id_transaksi'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 
    
    protected $table = 'transaksi_regol2';

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
    
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
