<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PenghuniRegol2;
use App\Models\LapPenghuniRegol2;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LapPenghuniRegol2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
{
    $lappenghuni_regol2 = LapPenghuniRegol2::with('user')->get();

    $bulanIni = Carbon::now()->month;
    $tahunIni = Carbon::now()->year;

    // Ambil semua data dari tabel laporan
    $lappenghuni_regol2 = LapPenghuniRegol2::all();

    // Hitung total penghuni aktif (dari tabel penghuni)
    $totalPenghuniAktif = DB::table('lap_penghuni_regol2')
        ->whereNull('tgl_keluar')
        ->count();

    // Penghuni baru (masuk bulan ini)
    $penghuniBaru = DB::table('lap_penghuni_regol2')
        ->whereMonth('tgl_masuk', $bulanIni)
        ->whereYear('tgl_masuk', $tahunIni)
        ->count();

    // Penghuni keluar
    $penghuniKeluar = DB::table('lap_penghuni_regol2')
        ->whereNotNull('tgl_keluar')
        ->count();

    // Kirim ke view
    return view('lappenghuni_regol2.index', compact(
        'lappenghuni_regol2',
        'totalPenghuniAktif',
        'penghuniBaru',
        'penghuniKeluar'
    ));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
     $lastKode = LapPenghuniRegol2::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_aset, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'LP-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    $penghuni_regol2 = DB::table('penghuni_kost_regol2 as p')
        ->leftJoin('lap_penghuni_regol2 as l', 'p.id_penghuni', '=', 'l.id_penghuni')
        ->whereNull('l.id_penghuni')
        ->select(
            'p.id_penghuni',
            'p.nama_penghuni',
            'p.tgl_masuk',
            'p.tgl_keluar',
            'p.status as status_penghuni', // alias disesuaikan
        DB::raw("
        CONCAT(
        TIMESTAMPDIFF(
            MONTH,
            p.tgl_masuk,
            COALESCE(p.tgl_keluar, CURDATE())
        ),
        ' Bulan ',
        DATEDIFF(
            COALESCE(p.tgl_keluar, CURDATE()),
            DATE_ADD(
                p.tgl_masuk,
                INTERVAL TIMESTAMPDIFF(
                    MONTH,
                    p.tgl_masuk,
                    COALESCE(p.tgl_keluar, CURDATE())
                ) MONTH
            )
        ),
        ' Hari'
    ) as durasi_sewa
    ")
        )
    ->get();
    return view('lappenghuni_regol2.create', compact('penghuni_regol2', 'newKode'));
}



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'id_lappenghuni' => 'required',
        'id_penghuni'        => 'required',
        'nama_penghuni'      => 'required',
        'tgl_masuk'          => 'required|date',
        'tgl_keluar'          => 'nullable',
        'status_penghuni'             => 'required',
    ]);

    DB::table('lap_penghuni_regol2')->insert([
        'id_lappenghuni' => $request->id_lappenghuni,
        'id_penghuni'        => $request->id_penghuni,
        'nama_penghuni'      => $request->nama_penghuni,
        'tgl_masuk'          => $request->tgl_masuk,
        'tgl_keluar'         => $request->tgl_keluar,
        'status_penghuni'             => $request->status_penghuni,
        'created_at'         => now(),
        'user_id'       => Auth::id(),
    ]);

    return redirect()->route('lappenghuni_regol2.index')
        ->with('success', 'Laporan penghuni berhasil ditambahkan');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_lappenghuni)
    {
        $lapppenghuni_regol2 = DB::table('lap_penghuni_regol2')->where('id_lappenghuni', $id_lappenghuni)->delete();
        if ($lapppenghuni_regol2) {
            return redirect('lappenghuni_regol2')->withSuccess('Data Laporan Penghuni Kost Regol 2 berhasil dihapus.');
        } else {
            return redirect('lappenghuni_regol2')->with('error', 'Data Laporan Penghuni Kost Regol 2 gagal dihapus.');
        }
    }
}
