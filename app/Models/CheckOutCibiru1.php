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

    public function getLamaTinggalFormattedAttribute()
    {
        $totalHari = (int) $this->lama_tinggal;

        if ($totalHari < 30) {
            return $totalHari . ' Hari';
        }

        $bulan = intdiv($totalHari, 30);
        $hari  = $totalHari % 30;

        if ($hari > 0) {
            return $bulan + ' Bulan ' + $hari + ' Hari';
        }

        return $bulan . ' Bulan';
    }

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
