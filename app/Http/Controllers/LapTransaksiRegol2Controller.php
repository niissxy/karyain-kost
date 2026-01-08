<?php

namespace App\Http\Controllers;

use App\Models\LapTransaksiRegol2;
use App\Models\LaTransaksiRegol2;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LapTransaksiRegol2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // DATA TABEL
    $laptransaksi_regol2 = LapTransaksiRegol2::all();

    // TOTAL TRANSAKSI
    $totalTransaksi = $laptransaksi_regol2->count();

    // TOTAL PEMASUKAN
    $pemasukan = $laptransaksi_regol2->sum('nominal');

    return view(
        'laptransaksi_regol2.index',
        compact('laptransaksi_regol2', 'totalTransaksi', 'pemasukan')
    );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $transaksi = DB::table('transaksi_regol2 as t')
        ->leftJoin('lap_transaksi_regol2 as l', 't.id_transaksi', '=', 'l.id_transaksi')
        ->whereNull('l.id_transaksi')
        ->select(
            't.id_transaksi',
            't.nama_penyewa',
            't.no_kamar',
            't.total_harga',
            't.status'
        )
        ->get();

    return view('laptransaksi_regol2.create', compact('transaksi'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('lap_transaksi_regol2')->insert([
        'id_transaksi'       => $request->id_transaksi,
        'nama_penghuni'      => $request->nama_penghuni,
        'no_kamar'           => $request->no_kamar,
        'nominal'            => $request->nominal,
        'status_pembayaran'  => $request->status_pembayaran,
        'created_at'         => now(),
        'user_id'       => Auth::id(),
    ]);

    return redirect()->route('laptransaksi_regol2.index')
        ->with('success', 'Laporan transaksi berhasil ditambahkan');
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
