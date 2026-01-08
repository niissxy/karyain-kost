<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SewaCibiru1;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SewaCibiru1Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        $sewa_cibiru1 = SewaCibiru1::with('user')->get();
        $sewa_cibiru1 = SewaCibiru1::all();
        return view('sewa_cibiru1.index', compact('sewa_cibiru1'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();

        $lastKode = SewaCibiru1::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_aset, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'S-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return view('sewa_cibiru1.create', compact('user'));
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
        'tgl_berakhir'           => 'required|date',
        'jatuh_tempo'               => 'required',
        'perpanjangan'               => 'required',
        ]);

        $data['user_id'] = Auth::id();

        SewaCibiru1::create($data);

        return redirect()->route('sewa_cibiru1.index')
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
        $sewa_cibiru1 = SewaCibiru1::where('id_sewa', $id_sewa)->first();
        return  view('sewa_cibiru1/edit', [
            'user' => $user,
            'sewa_cibiru1' => $sewa_cibiru1
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

        SewaCibiru1::where('id_sewa', $id_sewa)->update($data);

        if ($data) {
            return redirect()->route('sewa_cibiru1.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('sewa_cibiru1.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_sewa)
    {
        $sewa_cibiru1 = DB::table('sewa_cibiru1')->where('id_sewa', $id_sewa)->delete();
        if ($sewa_cibiru1) {
            return redirect('sewa_cibiru1')->withSuccess('Data Sewa Kost Cibiru 1 berhasil dihapus.');
        } else {
            return redirect('sewa_cibiru1')->with('error', 'Data Sewa Kost Cibiru 1 gagal dihapus.');
        }
    }
}
