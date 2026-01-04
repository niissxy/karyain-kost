<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenghuniRegol2 extends Model
{
    protected $table = 'penghuni_kost_regol2';

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
}
