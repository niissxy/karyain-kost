<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiCibiru1 extends Model
{
    protected $primaryKey = 'id_transaksi'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 
    protected $table = 'transaksi_cibiru1';

    protected $fillable = [
        'id_transaksi',
        'nama_penyewa',
        'total_penyewa',
        'no_kamar',
        'nominal',
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
