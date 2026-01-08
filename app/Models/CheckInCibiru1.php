<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CheckOutCibiru1;

class CheckInCibiru1 extends Model
{
    protected $table = 'checkin_cibiru1';
    protected $primaryKey = 'id_checkin';
    public $timestamps = true;
    protected $keyType = 'string';

    protected $fillable = [
        'id_checkin',
        'tgl_checkin',
        'nama_penghuni',
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
            CheckOutCibiru1::class,
            'id_checkin',
            'id_checkin'
        );
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

}
