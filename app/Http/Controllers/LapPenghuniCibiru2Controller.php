<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PenghuniCibiru2;
use App\Models\LapPenghuniCibiru2;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LapPenghuniCibiru2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
    $lappenghuni_cibiru2 = LapPenghuniCibiru2::with('user')->get();

    $bulanIni = Carbon::now()->month;
    $tahunIni = Carbon::now()->year;

     // DATA TABEL
    $lappenghuni_cibiru2 = LapPenghuniCibiru2::all();

    // Total penghuni aktif
   $totalPenghuniAktif = DB::table('lap_penghuni_cibiru2')
    ->whereNull('tgl_keluar')
    ->count();


    // Penghuni baru (masuk bulan ini)
    $penghuniBaru = DB::table('lap_penghuni_cibiru2')
        ->whereMonth('tgl_masuk', $bulanIni)
        ->whereYear('tgl_masuk', $tahunIni)
        ->count();

    // Penghuni keluar
   $penghuniKeluar = DB::table('lap_penghuni_cibiru2')
    ->whereNotNull('tgl_keluar')
    ->count();


    return view('lappenghuni_cibiru2.index', compact(
        'lappenghuni_cibiru2',
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
         $lastKode = LapPenghuniCibiru2::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_aset, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'LP-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    $penghuni_cibiru2 = DB::table('penghuni_kost_cibiru2 as p')
        ->leftJoin('lap_penghuni_cibiru2 as l', 'p.id_penghuni', '=', 'l.id_penghuni')
        ->whereNull('l.id_penghuni')
        ->select(
            'p.id_penghuni',
            'p.nama_penghuni',
            'p.status-penghuni',
            'p.tgl_masuk',
            'p.tgl_keluar',
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
    "),

    'p.status'
        )
    ->get();
    return view('lappenghuni_cibiru2.create', compact('penghuni_cibiru2', 'newKode'));
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
        'status_penghuni' => 'required',
        'tgl_masuk'          => 'required|date',
        'tgl_keluar'          => 'nullable',
        'durasi_sewa'          => 'required',
        'status'             => 'required',
    ]);

    DB::table('lap_penghuni_cibiru2')->insert([
        'id_lappenghuni' => $request->id_lappenghuni,
        'id_penghuni'        => $request->id_penghuni,
        'nama_penghuni'      => $request->nama_penghuni,
        'status_penghuni' => $request->status_penghuni,
        'tgl_masuk'          => $request->tgl_masuk,
        'tgl_keluar'         => $request->tgl_keluar,
        'durasi_sewa'         => $request->durasi_sewa,
        'status'             => $request->status,
        'created_at'         => now(),
        'user_id'       => Auth::id(),
    ]);

    return redirect()->route('lappenghuni_cibiru2.index')
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
        $lappenghuni_cibiru2 = DB::table('lap_penghuni_cibiru2')->where('id_lappenghuni', $id_lappenghuni)->delete();
        if ($lappenghuni_cibiru2) {
            return redirect('lappenghuni_cibiru2')->withSuccess('Data Laporan Penghuni Kost Cibiru 2 berhasil dihapus.');
        } else {
            return redirect('lappenghuni_cibiru2')->with('error', 'Data Laporan Penghuni Kost Cibiru 2 gagal dihapus.');
        }
    }
}
