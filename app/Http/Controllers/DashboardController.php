<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan import untuk DB

class DashboardController extends Controller
{
   public function __construct()
   {
    $this->middleware('auth');
   }

    public function index(Request $request)
{
    // Opsi kost (nama tabel)
    $kosts = [
        1 => 'cibiru1',
        2 => 'cibiru2',
        3 => 'regol1',
        4 => 'regol2'
    ];

    // Nama tampil (untuk UI)
    $kostDisplayNames = [
        1 => 'Kost Cibiru 1',
        2 => 'Kost Cibiru 2',
        3 => 'Kost Regol 1',
        4 => 'Kost Regol 2'
    ];

    // Default kost_id
    $kostId = $request->get('kost_id', 1);
    $kostName = $kosts[$kostId] ?? 'cibiru1';
    $kostDisplayName = $kostDisplayNames[$kostId] ?? 'Kost Cibiru 1';

    // Query berdasarkan kost
    $kamarKosong = DB::table("kamar_{$kostName}")->where('status_kamar', 'kosong')->count();
    $kamarTerisi = DB::table("kamar_{$kostName}")->where('status_kamar', 'terisi')->count();
    $pemasukan = DB::table("transaksi_{$kostName}")->sum('nominal');

    return view('dashboard', compact(
        'kosts', 
        'kostId', 
        'kostName', 
        'kostDisplayName', // tambahkan ini untuk tampilan
        'kamarKosong', 
        'kamarTerisi', 
        'pemasukan'
    ));
}

}