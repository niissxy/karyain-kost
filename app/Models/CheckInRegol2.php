<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckInRegol2 extends Model
{
    protected $table = 'checkin_regol2';

    protected $primaryKey = 'id_checkin';

    public $incrementing = false; // karena varchar
    protected $keyType = 'string';

    protected $fillable = [
        'id_checkin',
        'tgl_checkin',
        'nama_penghuni',
        'no_kamar',
        'nominal',
        'status',
        'user_id',
        'created_at',
        'updated_at'
    ];

    // RELASI WAJIB ADA
    public function checkout()
    {
        return $this->hasOne(
            CheckOutRegol2::class,
            'id_checkin',
            'id_checkin'
        );
    }

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
