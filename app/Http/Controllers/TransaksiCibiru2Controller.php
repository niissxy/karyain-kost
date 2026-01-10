<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiCibiru2;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransaksiCibiru2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        $transaksi_cibiru2 = TransaksiCibiru2::with('user')->get();
        $transaksi_cibiru2 = TransaksiCibiru2::all();
        return view('transaksi_cibiru2.index', compact('transaksi_cibiru2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();

        $lastKode = TransaksiCibiru2::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_aset, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'TR-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return view('transaksi_cibiru2.create', compact('user', 'newKode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'id_transaksi'          => 'required',
        'nama_penyewa'        => 'required',
        'total_penyewa'     => 'required|numeric',
        'durasi_sewa'               => 'required',
        'no_kamar'           => 'required',
        'nominal'               => 'required|numeric',
        'tgl_pembayaran' => 'required|date',
        'status' => 'required'
        ]);

        $data['user_id'] = Auth::id();

        TransaksiCibiru2::create($data);

        return redirect()->route('transaksi_cibiru2.index')
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
    public function edit(string $id_transaksi)
    {
        $user = User::all();
        $transaksi_cibiru2 = TransaksiCibiru2::where('id_transaksi', $id_transaksi)->first();
        return  view('transaksi_cibiru2/edit', [
            'user' => $user,
            'transaksi_cibiru2' => $transaksi_cibiru2
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_transaksi)
    {
        // $user = auth()->user();
        $data = [
            'id_transaksi' => $request->id_transaksi,
            'nama_penyewa' => $request->nama_penyewa,
            'total_penyewa' => $request->total_penyewa,
            'durasi_sewa' => $request->durasi_sewa,
            'no_kamar' => $request->no_kamar,
            'nominal' => $request->nominal,
            'tgl_pembayaran' => $request->tgl_pembayaran,
            'status' => $request->status,
            'updated_at' => now(), // Waktu diperbarui saat ini/ Nama pembuat
        ];

        TransaksiCibiru2::where('id_transaksi', $id_transaksi)->update($data);

        if ($data) {
            return redirect()->route('transaksi_cibiru2.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('transaksi_cibiru2.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_transaksi)
    {
        $transaksi_cibiru2 = DB::table('transaksi_cibiru2')->where('id_transaksi', $id_transaksi)->delete();
        if ($transaksi_cibiru2) {
            return redirect('transaksi_cibiru2')->withSuccess('Data Transaksi Kost Cibiru 2 berhasil dihapus.');
        } else {
            return redirect('transaksi_cibiru2')->with('error', 'Data Transaksi Kost Cibiru 2 gagal dihapus.');
        }
    }
}
