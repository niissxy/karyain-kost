<?php

namespace App\Http\Controllers;

use App\Models\AsetRegol1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class AsetRegol1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aset_regol1 = AsetRegol1::all();
        return view('aset_regol1.index', compact('aset_regol1'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        $user = User::all();

        $lastKode = AsetRegol1::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_aset, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'A-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);


        return view('aset_regol1.create', compact('user', 'newKode'));
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

        AsetRegol1::create($data);

        return redirect()->route('aset_regol1.index')
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
        $aset_regol1 = AsetRegol1::where('id_aset', $id_aset)->first();
        return  view('aset_regol1/edit', [
            'user' => $user,
            'aset_regol1' => $aset_regol1
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

        AsetRegol1::where('id_aset', $id_aset)->update($data);

        if ($data) {
            return redirect()->route('aset_regol1.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('aset_regol1.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_aset)
    {
        $aset_regol1 = DB::table('aset_kost_regol1')->where('id_aset', $id_aset)->delete();
        if ($aset_regol1) {
            return redirect('aset_regol1')->withSuccess('Data Aset Kost Regol 1 berhasil dihapus.');
        } else {
            return redirect('aset_regol1')->with('error', 'Data Aset Kost Regol 1 gagal dihapus.');
        }
    }
}
