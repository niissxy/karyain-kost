<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiCibiru2 extends Model
{
    protected $primaryKey = 'id_transaksi'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 
    
    protected $table = 'transaksi_cibiru2';

    protected $fillable = [
        'id_transaksi',
        'nama_penyewa',
        'total_penyewa',
        'no_kamar',
        'nominal',  
        'metode_pembayaran',      
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
