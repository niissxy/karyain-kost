<?php

namespace App\Http\Controllers;

use App\Models\FasKamarRegol2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class FasKamarRegol2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function index()
    {
        $faskamar_regol2 = FasKamarRegol2::with('user')->get();
        $faskamar_regol2 = FasKamarRegol2::all();
        return view('faskamar_regol2.index', compact('faskamar_regol2'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        
         $user = User::all();
        // Ambil aset yang kategorinya fasilitas kamar saja
        $asetFasilitasKamar = DB::table('aset_kost_regol2')
        ->where('kategori', 'fasilitas kamar')
        ->get();

     return view('faskamar_regol2.create', compact('asetFasilitasKamar'));
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

        FasKamarRegol2::create($data);

        return redirect()->route('faskamar_regol2.index')
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
        $faskamar_regol2 = FasKamarRegol2::where('id_fask', $id_fask)->first();
        return  view('faskamar_regol2/edit', [
            'user' => $user,
            'faskamar_regol2' => $faskamar_regol2
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

        FasKamarRegol2::where('id_fask', $id_fask)->update($data);

        if ($data) {
            return redirect()->route('faskamar_regol2.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('faskamar_regol2.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_fask)
    {
        $faskamar_regol2 = DB::table('fasilitas_kamar_regol2')->where('id_fask', $id_fask)->delete();
        if ($faskamar_regol2) {
            return redirect('faskamar_regol2')->withSuccess('Data Fasilitas Kamar Kost Regol 2 berhasil dihapus.');
        } else {
            return redirect('faskamar_regol2')->with('error', 'Data Fasilitas Kamar Kost Regol 2 gagal dihapus.');
        }
    }
}
