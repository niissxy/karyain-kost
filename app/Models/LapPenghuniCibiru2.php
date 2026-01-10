<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LapPenghuniCibiru2 extends Model
{
   protected $table = 'lap_penghuni_cibiru2';
    protected $fillable = [
        'id_lappenghuni',
        'id_penghuni',
        'nama_penghuni', 
        'tgl_masuk', 
        'tgl_keluar', 
        'durasi_sewa',
        'status_penghuni',
        'user_id',
        'created_at',
        'updated_at'
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDurasiSewaAttribute()
    {
    if (!$this->tgl_masuk) return '-';

    $tglMasuk  = Carbon::parse($this->tgl_masuk);
    $tglKeluar = $this->tgl_keluar
        ? Carbon::parse($this->tgl_keluar)
        : now();

    $totalHari = $tglMasuk->diffInDays($tglKeluar);

    $bulan = intdiv($totalHari, 30);
    $hari  = $totalHari % 30;

    if ($bulan > 0 && $hari > 0) return "$bulan Bulan $hari Hari";
    if ($bulan > 0) return "$bulan Bulan";
    return "$hari Hari";
    }
}
