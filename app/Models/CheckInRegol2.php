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
        'nama_penghuni',
        'lama_tinggal',
        'no_kamar',
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
}
