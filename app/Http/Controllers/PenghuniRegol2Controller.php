<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenghuniRegol2;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PenghuniRegol2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penghuni_regol2 = PenghuniRegol2::all();
        return view('penghuni_regol2.index', compact('penghuni_regol2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        return view('penghuni_regol2.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = $request->validate([
        'id_penghuni'          => 'required',
        'nama_penghuni'        => 'required',
        'penempatan_kamar'     => 'required',
        'alamat'               => 'required',
        'kontak'               => 'required',
        'tgl_masuk'            => 'required|date',
        'tgl_keluar'           => 'nullable',
        'status'               => 'required',
        ]);

        PenghuniRegol2::create($data);

        return redirect()->route('penghuni_regol2.index')
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
    public function edit(string $id_penghuni)
    {
        $user = User::all();
        $penghuni_regol2 = PenghuniRegol2::where('id_penghuni', $id_penghuni)->first();
        return  view('penghuni_regol2/edit', [
            'user' => $user,
            'penghuni_regol2' => $penghuni_regol2
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_penghuni)
    {
        $user = auth()->user();
        $data = [
            'id_penghuni' => $request->id_penghuni,
            'nama_penghuni' => $request->nama_penghuni,
            'penempatan_kamar' => $request->penempatan_kamar,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_keluar' => $request->tgl_keluar,
            'status' => $request->status,
            'updated_at' => now(), // Waktu diperbarui saat ini/ Nama pembuat
        ];

        PenghuniRegol2::where('id_penghuni', $id_penghuni)->update($data);

        if ($data) {
            return redirect()->route('penghuni_regol2.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('penghuni_regol2.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_penghuni)
    {
        $penghuni_regol2 = DB::table('penghuni_kost_regol2')->where('id_penghuni', $id_penghuni)->delete();
        if ($penghuni_regol2) {
            return redirect('penghuni_regol2')->withSuccess('Data Penghuni Kost Regol 2 berhasil dihapus.');
        } else {
            return redirect('penghuni_regol2')->with('error', 'Data Penghuni Kost Regol 2 gagal dihapus.');
        }
    }
}
