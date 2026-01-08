<?php

namespace App\Http\Controllers;

use App\Models\LapTransaksiCibiru2;
use App\Models\TransaksiCibiru2;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LapTransaksiCibiru2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
    $laptransaksi_cibir21 = LapTransaksiCibiru2::with('user')->get();
        // DATA TABEL
    $laptransaksi_cibiru2 = LapTransaksiCibiru2::all();

    // TOTAL TRANSAKSI
    $totalTransaksi = $laptransaksi_cibiru2->count();

    // TOTAL PEMASUKAN
    $pemasukan = $laptransaksi_cibiru2->sum('nominal');

    return view(
        'laptransaksi_cibiru2.index',
        compact('laptransaksi_cibiru2', 'totalTransaksi', 'pemasukan')
    );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastKode = LapTransaksiCibiru2::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_aset, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'LT-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

       $transaksi = DB::table('transaksi_cibiru2 as t')
        ->leftJoin('lap_transaksi_cibiru2 as l', 't.id_transaksi', '=', 'l.id_transaksi')
        ->whereNull('l.id_transaksi')
        ->select(
            't.id_transaksi',
            't.nama_penyewa',
            't.no_kamar',
            't.total_harga',
            't.status'
        )
        ->get();

    return view('laptransaksi_cibiru2.create', compact('transaksi', 'newKode'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('lap_transaksi_cibiru2')->insert([
        'id_transaksi'       => $request->id_transaksi,
        'nama_penghuni'      => $request->nama_penghuni,
        'no_kamar'           => $request->no_kamar,
        'nominal'            => $request->nominal,
        'status_pembayaran'  => $request->status_pembayaran,
        'created_at'         => now(),
        'user_id'       => Auth::id(),
    ]);

    return redirect()->route('laptransaksi_cibiru2.index')
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
