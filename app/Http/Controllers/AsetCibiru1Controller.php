<?php

namespace App\Http\Controllers;

use App\Models\AsetCibiru1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class AsetCibiru1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aset_cibiru1 = AsetCibiru1::all();
        return view('aset_cibiru1.index', compact('aset_cibiru1'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        $user = User::all();

        $lastKode = AsetCibiru1::latest()->first();

        if($lastKode) {
            $lastNumber = (int) substr($lastKode->id_aset, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'A-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return view('aset_cibiru1.create', compact('user', 'newKode'));
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

        AsetCibiru1::create($data);

        return redirect()->route('aset_cibiru1.index')
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
        $aset_cibiru1 = AsetCibiru1::where('id_aset', $id_aset)->first();
        return  view('aset_cibiru1/edit', [
            'user' => $user,
            'aset_cibiru1' => $aset_cibiru1
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

        AsetCibiru1::where('id_aset', $id_aset)->update($data);

        if ($data) {
            return redirect()->route('aset_cibiru1.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('aset_cibiru1.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_aset)
    {
        $aset_cibiru1 = DB::table('aset_kost_cibiru1')->where('id_aset', $id_aset)->delete();
        if ($aset_cibiru1) {
            return redirect('aset_cibiru1')->withSuccess('Data Aset Kost Cibiru 1 berhasil dihapus.');
        } else {
            return redirect('aset_cibiru1')->with('error', 'Data Aset Kost Cibiru 1 gagal dihapus.');
        }
    }
}
