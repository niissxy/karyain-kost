<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenghuniRegol2 extends Model
{
    
    protected $primaryKey = 'id_penghuni'; // jika bukan id
    public $incrementing = false; // jika id_penghuni manual
    protected $keyType = 'string'; // jika varchar
    
    protected $table = 'penghuni_kost_regol2';

    protected $fillable = [
        'id_penghuni',
        'nama_penghuni', 
        'status_penghuni',
        'penempatan_kamar', 
        'alamat', 
        'kontak',
        'durasi_sewa',
        'tgl_masuk',
        'tgl_keluar',
        'status',
        'user_id',
        'created_at',
        'updated_at'
    ];

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
