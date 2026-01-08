<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SewaRegol1;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SewaRegol1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $sewa_regol1 = SewaRegol1::all();
        return view('sewa_regol1.index', compact('sewa_regol1'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        return view('sewa_regol1.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = $request->validate([
        'id_sewa'          => 'required',
        'nama_penyewa'        => 'required',
        'durasi_sewa'     => 'required',
        'tgl_mulai'               => 'required|date',
        'tgl_berakhir'           => 'nullable',
        'jatuh_tempo'               => 'required',
        'perpanjangan'               => 'required',
        ]);

        $data['user_id'] = Auth::id();

        SewaRegol1::create($data);

        return redirect()->route('sewa_regol1.index')
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
    public function edit(string $id_sewa)
    {
        $user = User::all();
        $sewa_regol1 = SewaRegol1::where('id_sewa', $id_sewa)->first();
        return  view('sewa_regol1/edit', [
            'user' => $user,
            'sewa_regol1' => $sewa_regol1
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_sewa)
    {
        // $user = auth()->user();
        $data = [
            'id_sewa' => $request->id_sewa,
            'nama_penyewa' => $request->nama_penyewa,
            'durasi_sewa' => $request->durasi_sewa,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_berakhir' => $request->tgl_berakhir,
            'jatuh_tempo' => $request->jatuh_tempo,
            'perpanjangan' => $request->perpanjangan,
            'updated_at' => now(), // Waktu diperbarui saat ini/ Nama pembuat
        ];

        SewaRegol1::where('id_sewa', $id_sewa)->update($data);

        if ($data) {
            return redirect()->route('sewa_regol1.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('sewa_regol1.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_sewa)
    {
        $sewa_regol1 = DB::table('sewa_regol1')->where('id_sewa', $id_sewa)->delete();
        if ($sewa_regol1) {
            return redirect('sewa_regol1')->withSuccess('Data Sewa Kost Regol 1 berhasil dihapus.');
        } else {
            return redirect('sewa_regol1')->with('error', 'Data Sewa Kost Regol 1 gagal dihapus.');
        }
    }
}
