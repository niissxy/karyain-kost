<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LapPenghuniRegol1 extends Model
{
    protected $table = 'lap_penghuni_regol1';
    protected $fillable = [
        'id_penghuni',
        'nama_penghuni', 
        'tgl_masuk', 
        'tgl_keluar', 
        'durasi_sewa',
        'status_penghuni',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
