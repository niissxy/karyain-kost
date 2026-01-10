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
    public function index(Request $request) // Tambahkan parameter Request $request
    {
        // Opsi kost
        $kosts = [
            1 => 'cibiru1',
            2 => 'cibiru2',
            3 => 'regol1',
            4 => 'regol2'
        ];

        // Default kost_id
        $kostId = $request->get('kost_id', 1);
        $kostName = $kosts[$kostId] ?? 'cibiru1';

        // Query berdasarkan kost
        $kamarKosong = DB::table("kamar_{$kostName}")->where('status_kamar', 'kosong')->count();
        $kamarTerisi = DB::table("kamar_{$kostName}")->where('status_kamar', 'terisi')->count();
        $pemasukan = DB::table("transaksi_{$kostName}")->sum('nominal'); // Sum total_bayar sebagai pemasukan

        return view('dashboard', compact('kosts', 'kostId', 'kostName', 'kamarKosong', 'kamarTerisi', 'pemasukan'));
    }
}