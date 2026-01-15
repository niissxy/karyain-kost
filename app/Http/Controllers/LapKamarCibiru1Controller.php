<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KamarCibiru1;
use App\Models\LapKamarCibiru1;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LapKamarCibiru1Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
{
    $lapkamar_cibiru1 = LapKamarCibiru1::with('user')->get();
    // Ambil semua kamar
    // Hitung berdasarkan status
    $jumlahKamarTerisi = DB::table('lap_kamar_cibiru1')
        ->where('status_kamar', 'terisi')
        ->count();

    $jumlahKamarKosong = DB::table('lap_kamar_cibiru1')
        ->where('status_kamar', 'kosong')
        ->count();

    $jumlahKamarDibooking = DB::table('lap_kamar_cibiru1')
        ->where('status_kamar', 'booked')
        ->count();

    return view('lapkamar_cibiru1.index', compact(
        'lapkamar_cibiru1',
        'jumlahKamarTerisi',
        'jumlahKamarKosong',
        'jumlahKamarDibooking'
    ));
}

public function create()
{
    // Ambil semua kamar agar bisa dipilih di form
    $lapkamar_cibiru1 = DB::table('kamar_cibiru1')->get();

     $lastKode = LapKamarCibiru1::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_ase, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'LK-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    return view('lapkamar_cibiru1.create', compact('lapkamar_cibiru1', 'newKode'));
}



    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'id_lapkamar'  => 'required',
        'id_kamar'     => 'required',
        'no_kamar'     => 'required',
        'tipe_kamar'   => 'required',
        'status_kamar' => 'required',
        'harga_harian'        => 'required|numeric',
        'harga_bulanan' => 'required|numeric',
    ]);

    DB::table('lap_kamar_cibiru1')->insert([
        'id_lapkamar'  => $request->id_lapkamar,
        'id_kamar'     => $request->id_kamar,
        'no_kamar'     => $request->no_kamar,
        'tipe_kamar'   => $request->tipe_kamar,
        'status_kamar' => $request->status_kamar,
        'harga_harian'        => str_replace('.', '', $request->harga_harian),
        'harga_bulanan'        => str_replace('.', '', $request->harga_bulanan),
        'user_id'       => Auth::id(),
        'created_at'   => now(),
    ]);

    return redirect()
        ->route('lapkamar_cibiru1.index')
        ->with('success', 'Data kamar berhasil ditambahkan');
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
    public function destroy(string $id_lapkamar)
    {
        $lapkamar_cibiru1 = DB::table('lap_kamar_cibiru1')->where('id_lapkamar', $id_lapkamar)->delete();
        if ($lapkamar_cibiru1) {
            return redirect('lapkamar_cibiru1')->withSuccess('Data Laporan Kamar Kost Cibiru 1 berhasil dihapus.');
        } else {
            return redirect('lapkamar_cibiru1')->with('error', 'Data Laporan Kamar Kost Cibiru 1 gagal dihapus.');
        }
    }
}
