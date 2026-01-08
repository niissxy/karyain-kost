<?php

namespace App\Http\Controllers;

use App\Models\AsetCibiru2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class AsetCibiru2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aset_cibiru2 = AsetCibiru2::all();
        return view('aset_cibiru2.index', compact('aset_cibiru2'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        $user = User::all();

        $lastKode = AsetCibiru2::latest()->first();

        if($lastKode) {
            $lastNumber = (int) substr($lastKode->id_aset, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'A-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return view('aset_cibiru2.create', compact('user', 'newKode'));
    }


    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
     $data = $request->validate([
        'id_aset'     => 'required',
        'nama_aset'   => 'required',
        'kategori'     => 'required',
        'jumlah' => 'required',
        'kondisi'        => 'required ',
        ]);

        $data['user_id'] = Auth::id();

        AsetCibiru2::create($data);

        return redirect()->route('aset_cibiru2.index')
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
   public function edit(string $id_aset)
    {
        $user = User::all();
        $aset_cibiru2 = AsetCibiru2::where('id_aset', $id_aset)->first();
        return  view('aset_cibiru2/edit', [
            'user' => $user,
            'aset_cibiru2' => $aset_cibiru2
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id_aset)
    {

        $data = [
            'id_aset' => $request->id_aset,
            'nama_aset' => $request->nama_aset,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah,
            'kondisi' => $request->kondisi,
        ];

        AsetCibiru2::where('id_aset', $id_aset)->update($data);

        if ($data) {
            return redirect()->route('aset_cibiru2.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('aset_cibiru2.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_aset)
    {
        $aset_cibiru2 = DB::table('aset_kost_cibiru2')->where('id_aset', $id_aset)->delete();
        if ($aset_cibiru2) {
            return redirect('aset_cibiru2')->withSuccess('Data Aset Kost Cibiru 2 berhasil dihapus.');
        } else {
            return redirect('aset_cibiru2')->with('error', 'Data Aset Kost Cibiru 2 gagal dihapus.');
        }
    }
}
