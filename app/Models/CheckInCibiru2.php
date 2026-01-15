<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckInCibiru2 extends Model
{
    protected $table = 'checkin_cibiru2';

    protected $primaryKey = 'id_checkin';

    public $incrementing = false; // karena varchar
    protected $keyType = 'string';

    protected $fillable = [
        'id_checkin',
        'tgl_checkin',
        'nama_penghuni',
        'no_kamar',
        'nominal',
        'metode_pembayaran',
        'status',
        'user_id',
        'created_at',
        'updated_at'
    ];

    // RELASI WAJIB ADA
    public function checkout()
    {
        return $this->hasOne(
            CheckOutCibiru2::class,
            'id_checkin',
            'id_checkin'
        );
    }

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
