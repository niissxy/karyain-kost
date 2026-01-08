<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenghuniCibiru2;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PenghuniCibiru2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        $penghuni_cibiru2 = PenghuniCibiru2::with('user')->get();
        $penghuni_cibiru2 = PenghuniCibiru2::all();
        return view('penghuni_cibiru2.index', compact('penghuni_cibiru2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();

         $lastKode = PenghuniCibiru2::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_aset, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'P-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return view('penghuni_cibiru2.create', compact('user', 'newKode'));
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
        'tgl_masuk'            => 'required',
        'tgl_keluar'           => 'nullable',
        'status'               => 'required',
         'created_at'          => now(),
        ]);

        $data['user_id'] = Auth::id();

        PenghuniCibiru2::create($data);

        return redirect()->route('penghuni_cibiru2.index')
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
        $penghuni_cibiru2 = PenghuniCibiru2::where('id_penghuni', $id_penghuni)->first();
        return  view('penghuni_cibiru2/edit', [
            'user' => $user,
            'penghuni_cibiru2' => $penghuni_cibiru2
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_penghuni)
    {
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

        PenghuniCibiru2::where('id_penghuni', $id_penghuni)->update($data);

        if ($data) {
            return redirect()->route('penghuni_cibiru2.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('penghuni_cibiru2.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_penghuni)
    {
        $penghuni_cibiru2 = DB::table('penghuni_kost_cibiru2')->where('id_penghuni', $id_penghuni)->delete();
        if ($penghuni_cibiru2) {
            return redirect('penghuni_cibiru2')->withSuccess('Data Penghuni Kost Cibiru 2 berhasil dihapus.');
        } else {
            return redirect('penghuni_cibiru2')->with('error', 'Data Penghuni Kost Cibiru 2 gagal dihapus.');
        }
    }
}
