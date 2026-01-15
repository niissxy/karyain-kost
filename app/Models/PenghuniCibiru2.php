<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenghuniCibiru2 extends Model
{
     // Primary key bukan 'id', tapi 'id_penghuni'
    protected $primaryKey = 'id_penghuni';

    // Jika primary key bukan auto-increment, beri tahu:
    public $incrementing = false;

    // Jika primary key bukan integer, tapi string
    protected $keyType = 'string';
    
    protected $table = 'penghuni_kost_cibiru2';

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
