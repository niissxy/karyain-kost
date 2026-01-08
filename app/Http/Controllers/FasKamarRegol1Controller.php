<?php

namespace App\Http\Controllers;

use App\Models\FasKamarRegol1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class FasKamarRegol1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faskamar_regol1 = FasKamarRegol1::all();
        return view('faskamar_regol1.index', compact('faskamar_regol1'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
         $user = User::all();
        // Ambil aset yang kategorinya fasilitas kamar saja
        $asetFasilitasKamar = DB::table('aset_kost_regol1')
        ->where('kategori', 'fasilitas kamar')
        ->get();

     return view('faskamar_regol1.create', compact('asetFasilitasKamar'));
    }


    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
     $data = $request->validate([
        'id_fask'     => 'required',
        'nama_fasilitas'   => 'required',
        'no_kamar'     => 'required',
        'kondisi'        => 'required ',
        ]);

         $data['user_id'] = Auth::id();

        FasKamarRegol1::create($data);

        return redirect()->route('faskamar_regol1.index')
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
   public function edit(string $id_fask)
    {
        $user = User::all();
        $faskamar_regol1 = FasKamarRegol1::where('id_fask', $id_fask)->first();
        return  view('faskamar_regol1/edit', [
            'user' => $user,
            'faskamar_regol1' => $faskamar_regol1
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id_fask)
    {

        $data = [
            'id_fask' => $request->id_fask,
            'nama_fasilitas' => $request->nama_fasilitas,
            'no_kamar' => $request->no_kamar,
            'kondisi' => $request->kondisi,
        ];

        FasKamarRegol1::where('id_fask', $id_fask)->update($data);

        if ($data) {
            return redirect()->route('faskamar_regol1.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('faskamar_regol1.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_fask)
    {
        $faskamar_regol1 = DB::table('fasilitas_kamar_regol1')->where('id_fask', $id_fask)->delete();
        if ($faskamar_regol1) {
            return redirect('faskamar_regol1')->withSuccess('Data Fasilitas Kamar Kost Regol 1 berhasil dihapus.');
        } else {
            return redirect('faskamar_regol1')->with('error', 'Data Fasilitas Kamar Kost Regol 1 gagal dihapus.');
        }
    }
}
