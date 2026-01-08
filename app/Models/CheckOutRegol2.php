<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CheckInRegol2;

class CheckOutRegol2 extends Model
{
    protected $table = 'checkout_regol2';
    protected $primaryKey = 'id_checkout';
    public $timestamps = true;
    public $incrementing = false; // jika pakai string

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
        'updated_at'
    ];

    public function checkin()
    {
        return $this->belongsTo(
            CheckInRegol2::class,
            'id_checkin',
            'id_checkin'
        );
    }

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
