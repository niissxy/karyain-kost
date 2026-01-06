<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckInRegol1 extends Model
{
    protected $table = 'checkin_regol1';

    protected $fillable = [
        'id_checkin',
        'tgl_checkin',
        'nama_penghuni',
        'lama_tinggal',
        'status',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
