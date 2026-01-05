<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PenghuniRegol2;
use App\Models\LapPenghuniRegol2;
use App\Models\User;
use Carbon\Carbon;

class LapPenghuniRegol2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $bulanIni = Carbon::now()->month;
    $tahunIni = Carbon::now()->year;

    // Ambil semua data dari tabel laporan
    $lappenghuni_regol2 = LapPenghuniRegol2::all();

    // Hitung total penghuni aktif (dari tabel penghuni)
    $totalPenghuniAktif = DB::table('penghuni_kost_regol2')
        ->whereNull('tgl_keluar')
        ->count();

    // Penghuni baru (masuk bulan ini)
    $penghuniBaru = DB::table('penghuni_kost_regol2')
        ->whereMonth('tgl_masuk', $bulanIni)
        ->whereYear('tgl_masuk', $tahunIni)
        ->count();

    // Penghuni keluar
    $penghuniKeluar = DB::table('penghuni_kost_regol2')
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
    $penghuni_regol2 = DB::table('penghuni_kost_regol2 as p')
        ->leftJoin('lap_penghuni_regol2 as l', 'p.id_penghuni', '=', 'l.id_penghuni')
        ->whereNull('l.id_penghuni')
        ->select(
            'p.id_penghuni',
            'p.nama_penghuni',
            'p.tgl_masuk',
            'p.tgl_keluar',
            'p.status as status_penghuni', // ✅ alias disesuaikan
            DB::raw("
                TIMESTAMPDIFF(
                    MONTH,
                    p.tgl_masuk,
                    COALESCE(p.tgl_keluar, CURDATE())
                ) as durasi_sewa
            ")
        )
        ->get();

    return view('lappenghuni_regol2.create', compact('penghuni_regol2'));
}



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'id_penghuni'        => 'required',
        'nama_penghuni'      => 'required',
        'tgl_masuk'          => 'required|date',
        'tgl_keluar'          => 'nullable',
        'status_penghuni'             => 'required',
    ]);

    DB::table('lap_penghuni_regol2')->insert([
        'id_penghuni'        => $request->id_penghuni,
        'nama_penghuni'      => $request->nama_penghuni,
        'tgl_masuk'          => $request->tgl_masuk,
        'tgl_keluar'         => $request->tgl_keluar,
        'status_penghuni'             => $request->status_penghuni,
        'created_at'         => now(),
        'updated_at'         => now(),
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
    public function destroy(string $id)
    {
        //
    }
}
