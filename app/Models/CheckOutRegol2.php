<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckOutRegol2 extends Model
{
    protected $table = 'checkout_regol2';

    protected $fillable = [
        'id_checkout',
        'id_checkin',
        'tgl_checkout',
        'nama_penghuni',
        'lama_tinggal',
        'no_kamar',
        'status',
        'user_id',
        'created_at',
        'updated_at',
    ];
}
