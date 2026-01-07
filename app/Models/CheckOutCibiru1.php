<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CheckInCibiru1;

class CheckOutCibiru1 extends Model
{
    protected $table = 'checkout_cibiru1';
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
            CheckInCibiru1::class,
            'id_checkin',
            'id_checkin'
        );
    }
}
