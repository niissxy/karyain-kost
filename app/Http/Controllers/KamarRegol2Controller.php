<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KamarRegol2;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KamarRegol2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        $kamar_regol2 = KamarRegol2::with('user')->get();
        $kamar_regol2 = KamarRegol2::all();
        return view('kamar_regol2.index', compact('kamar_regol2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        return view('kamar_regol2.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'id_kamar'     => 'required',
        'tipe_kamar'   => 'required',
        'no_kamar'     => 'required',
        'status_kamar' => 'required',
        'harga'        => 'required',
        'created_at'        => now(),
        ]);

         $data['user_id'] = Auth::id();

        KamarRegol2::create($data);

        return redirect()->route('kamar_regol2.index')
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
    public function edit(string $id_kamar)
    {
        $user = User::all();
        $kamar_regol2 = KamarRegol2::where('id_kamar', $id_kamar)->first();
        return  view('kamar_regol2/edit', [
            'user' => $user,
            'kamar_regol2' => $kamar_regol2
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_kamar)
    {
        $data = [
            'id_kamar' => $request->id_kamar,
            'tipe_kamar' => $request->tipe_kamar,
            'no_kamar' => $request->no_kamar,
            'status_kamar' => $request->status_kamar,
            'harga' => $request->harga,
            'updated_at' => now(), // Waktu diperbarui saat ini/ Nama pembuat
        ];

        KamarRegol2::where('id_kamar', $id_kamar)->update($data);

        if ($data) {
            return redirect()->route('kamar_regol2.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('kamar_regol2.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_kamar)
    {
        $kamar_regol2 = DB::table('kamar_regol2')->where('id_kamar', $id_kamar)->delete();
        if ($kamar_regol2) {
            return redirect('kamar_regol2')->withSuccess('Data Kamar Kost Regol 2 berhasil dihapus.');
        } else {
            return redirect('kamar_regol2')->with('error', 'Data Kamar Kost Regol 2 gagal dihapus.');
        }
    }
}
