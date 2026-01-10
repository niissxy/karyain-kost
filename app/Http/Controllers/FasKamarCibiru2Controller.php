<?php

namespace App\Http\Controllers;

use App\Models\FasKamarCibiru2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class FasKamarCibiru2Controller extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
   
    public function index()
    {
        $faskamar_cibiru2 = FasKamarCibiru2::with('user')->get();
        $faskamar_cibiru2 = FasKamarCibiru2::all();
        return view('faskamar_cibiru2.index', compact('faskamar_cibiru2'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
         $user = User::all();

         $lastKode = FasKamarCibiru2::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_fask, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'FK-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Ambil aset yang kategorinya fasilitas kamar saja
        $asetFasilitasKamar = DB::table('aset_kost_cibiru2')
        ->where('kategori', 'fasilitas kamar')
        ->whereIn('kondisi', ['Baik', 'Perbaikan', 'Rusak'])
        ->get();

     return view('faskamar_cibiru2.create', compact('asetFasilitasKamar', 'newKode'));
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

        FasKamarCibiru2::create($data);

        return redirect()->route('faskamar_cibiru2.index')
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
        $faskamar_cibiru2 = FasKamarCibiru2::where('id_fask', $id_fask)->first();
        return  view('faskamar_cibiru2/edit', [
            'user' => $user,
            'faskamar_cibiru2' => $faskamar_cibiru2
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

        DB::table('aset_kost_cibiru2')
        ->where('kategori', 'Fasilitas kamar')
        ->where('nama_aset', $request->nama_fasilitas)
        ->update([
            'kondisi' =>$request->kondisi
        ]);

        FasKamarCibiru2::where('id_fask', $id_fask)->update($data);

        if ($data) {
            return redirect()->route('faskamar_cibiru2.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('faskamar_cibiru2.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_fask)
    {
        $faskamar_cibiru2 = DB::table('fasilitas_kamar_cibiru2')->where('id_fask', $id_fask)->delete();
        if ($faskamar_cibiru2) {
            return redirect('faskamar_cibiru2')->withSuccess('Data Fasilitas Kamar Kost Cibiru 2 berhasil dihapus.');
        } else {
            return redirect('faskamar_cibiru2')->with('error', 'Data Fasilitas Kamar Kost Cibiru 2 gagal dihapus.');
        }
    }
}
