<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\FasumCibiru2;
use Illuminate\Support\Facades\Auth;

class FasumCibiru2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fasum_cibiru2 = FasumCibiru2::all();
        return view('fasum_cibiru2.index', compact('fasum_cibiru2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        // Ambil aset yang kategorinya fasilitas umum saja
        $asetFasilitasUmum = DB::table('aset_kost_cibiru2')
        ->where('kategori', 'fasilitas umum')
        ->get();

     return view('fasum_cibiru2.create', compact('asetFasilitasUmum'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'id_fasum'     => 'required',
        'nama_fasilitas'   => 'required',
        'kondisi'        => 'required ',
        ]);

         $data['user_id'] = Auth::id();

        FasumCibiru2::create($data);

        return redirect()->route('fasum_cibiru2.index')
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
    public function edit(string $id_fasum)
    {
        $user = User::all();
        $fasum_cibiru2 = FasumCibiru2::where('id_fasum', $id_fasum)->first();
        return  view('fasum_cibiru2/edit', [
            'user' => $user,
            'fasum_cibiru2' => $fasum_cibiru2
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_fasum)
    {
        $data = [
            'id_fasum' => $request->id_fasum,
            'nama_fasilitas' => $request->nama_fasilitas,
            'kondisi' => $request->kondisi,
        ];

        FasumCibiru2::where('id_fasum', $id_fasum)->update($data);

        if ($data) {
            return redirect()->route('fasum_cibiru2.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('fasum_cibiru2.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_fasum)
    {
         $fasum_cibiru2 = DB::table('fasilitas_umum_cibiru2')->where('id_fasum', $id_fasum)->delete();
        if ($fasum_cibiru2) {
            return redirect('fasum_cibiru2')->withSuccess('Data Fasilitas Umum Kost Cibiru 2 berhasil dihapus.');
        } else {
            return redirect('fasum_cibiru2')->with('error', 'Data Fasilitas Umum Kost Cibiru 2 gagal dihapus.');
        }
    }
}
