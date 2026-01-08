<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PenghuniRegol1;
use App\Models\LapPenghuniRegol1;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LapPenghuniRegol1Controller extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    
    public function index()
    {
    $lappenghuni_regol1 = LapPenghuniRegol1::with('user')->get();

    $bulanIni = Carbon::now()->month;
    $tahunIni = Carbon::now()->year;

     // DATA TABEL
    $lappenghuni_regol1 = LapPenghuniRegol1::all();

    // Total penghuni aktif
   $totalPenghuniAktif = DB::table('penghuni_kost_regol1')
    ->whereNull('tgl_keluar')
    ->count();


    // Penghuni baru (masuk bulan ini)
    $penghuniBaru = DB::table('penghuni_kost_regol1')
        ->whereMonth('tgl_masuk', $bulanIni)
        ->whereYear('tgl_masuk', $tahunIni)
        ->count();

    // Penghuni keluar
   $penghuniKeluar = DB::table('penghuni_kost_regol1')
    ->whereNotNull('tgl_keluar')
    ->count();


    return view('lappenghuni_regol1.index', compact(
        'lappenghuni_regol1',
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
    $penghuni_regol1 = DB::table('penghuni_kost_regol1 as p')
        ->leftJoin('lap_penghuni_regol1 as l', 'p.id_penghuni', '=', 'l.id_penghuni')
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

    return view('lappenghuni_regol1.create', compact('penghuni_regol1'));
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

    DB::table('lap_penghuni_regol1')->insert([
        'id_penghuni'        => $request->id_penghuni,
        'nama_penghuni'      => $request->nama_penghuni,
        'tgl_masuk'          => $request->tgl_masuk,
        'tgl_keluar'         => $request->tgl_keluar,
        'status_penghuni'             => $request->status_penghuni,
        'created_at'         => now(),
        'user_id'       => Auth::id(),
    ]);

    return redirect()->route('lappenghuni_regol1.index')
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
