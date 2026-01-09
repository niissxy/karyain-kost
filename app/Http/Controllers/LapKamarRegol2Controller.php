<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KamarRegol2;
use App\Models\LapKamarRegol2;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LapKamarRegol2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
{
    $lapkamar_regol2 = LapKamarRegol2::with('user')->get();
    // Ambil semua kamar
    $lapkamar_regol2 = DB::table('lap_kamar_regol2')->get();

    // Hitung berdasarkan status
    $jumlahKamarTerisi = DB::table('lap_kamar_regol2')
        ->where('status_kamar', 'terisi')
        ->count();

    $jumlahKamarKosong = DB::table('lap_kamar_regol2')
        ->where('status_kamar', 'kosong')
        ->count();

    $jumlahKamarDibooking = DB::table('lap_kamar_regol2')
        ->where('status_kamar', 'booked')
        ->count();

    return view('lapkamar_regol2.index', compact(
        'lapkamar_regol2',
        'jumlahKamarTerisi',
        'jumlahKamarKosong',
        'jumlahKamarDibooking'
    ));
}

public function create()
{
     $lastKode = LapKamarRegol2::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_aset, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'LK-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    // Ambil semua kamar agar bisa dipilih di form
    $lapkamar_regol2 = DB::table('kamar_regol2')->get();

    return view('lapkamar_regol2.create', compact('lapkamar_regol2', 'newKode'));
}



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_lapkamar' => 'required',
            'id_kamar' => 'required',
            'no_kamar'     => 'required',
            'tipe_kamar'   => 'required',
            'status_kamar' => 'required',
            'harga'        => 'required|numeric',
        ]);

        DB::table('lap_kamar_regol2')->insert([
            'id_lapkamar' => $request->id_lapkamar,
            'id_kamar'     => $request->id_kamar,
            'no_kamar'     => $request->no_kamar,
            'tipe_kamar'   => $request->tipe_kamar,
            'status_kamar' => $request->status_kamar,
            'harga'        => $request->harga,
            'created_at'   => now(),
            'user_id'       => Auth::id(),
        ]);

        return redirect()->route('lapkamar_regol2.index')
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
    public function destroy(string $id)
    {
        //
    }
}
