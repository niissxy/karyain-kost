<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KamarRegol1;
use App\Models\User;

class KamarRegol1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kamar_regol1 = KamarRegol1::all();
        return view('kamar_regol1.index', compact('kamar_regol1'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        return view('kamar_regol1.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'id_kamar'     => 'required',
        'tipe_kamar'   => 'required',
        'no_kamar'     => 'required',
        'status_kamar' => 'required',
        'harga'        => 'required',
        'created_at'        => now(),
        ]);

        KamarRegol1::create($data);

        return redirect()->route('kamar_regol1.index')
            ->with('success', 'Data berhasil ditambahkan');
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
    public function edit(string $id_kamar)
    {
        $user = User::all();
        $kamar_regol1 = KamarRegol1::where('id_kamar', $id_kamar)->first();
        return  view('kamar_regol1/edit', [
            'user' => $user,
            'kamar_regol1' => $kamar_regol1
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_kamar)
    {
        $user = auth()->user();
        $data = [
            'id_kamar' => $request->id_kamar,
            'tipe_kamar' => $request->tipe_kamar,
            'no_kamar' => $request->no_kamar,
            'status_kamar' => $request->status_kamar,
            'harga' => $request->harga,
            'updated_at' => now(), // Waktu diperbarui saat ini/ Nama pembuat
        ];

        KamarRegol1::where('id_kamar', $id_kamar)->update($data);

        if ($data) {
            return redirect()->route('kamar_regol1.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('kamar_regol1.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_kamar)
    {
        $kamar_regol1 = DB::table('kamar_regol1')->where('id_kamar', $id_kamar)->delete();
        if ($kamar_regol1) {
            return redirect('kamar_regol1')->withSuccess('Data Kamar Kost Regol 1 berhasil dihapus.');
        } else {
            return redirect('kamar_regol1')->with('error', 'Data Kamar Kost Regol 1 gagal dihapus.');
        }
    }
}
