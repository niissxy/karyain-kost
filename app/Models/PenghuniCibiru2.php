<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenghuniCibiru2 extends Model
{
    protected $table = 'penghuni_kost_cibiru2';

    protected $fillable = [
        'id_penghuni',
        'nama_penghuni', 
        'penempatan_kamar', 
        'alamat', 
        'kontak',
        'durasi_sewa',
        'tgl_masuk',
        'tgl_keluar',
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
