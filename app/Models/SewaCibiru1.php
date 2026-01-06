<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SewaCibiru1 extends Model
{
    protected $table = 'sewa_cibiru1';

    protected $fillable = [
        'id_sewa',
        'nama_penyewa',
        'durasi_sewa',
        'tgl_mulai',
        'tgl_berakhir',
        'jatuh_tempo',
        'perpanjangan',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
