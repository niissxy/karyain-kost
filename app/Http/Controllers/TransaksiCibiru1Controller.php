<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiCibiru1;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransaksiCibiru1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi_cibiru1 = TransaksiCibiru1::all();
        return view('transaksi_cibiru1.index', compact('transaksi_cibiru1'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        return view('transaksi_cibiru1.create', compact('user'));
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
        'total_harga'               => 'required|numeric',
        'total_bayar'               => 'required|numeric',
        'tgl_pembayaran' => 'required|date',
        'status' => 'required'
        ]);

        $data['user_id'] = Auth::id();

        TransaksiCibiru1::create($data);

        return redirect()->route('transaksi_cibiru1.index')
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
        $transaksi_cibiru1 = TransaksiCibiru1::where('id_transaksi', $id_transaksi)->first();
        return  view('transaksi_cibiru1/edit', [
            'user' => $user,
            'transaksi_cibiru1' => $transaksi_cibiru1
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
            'total_harga' => $request->total_harga,
            'total_bayar' => $request->total_bayar,
            'tgl_pembayaran' => $request->tgl_pembayaran,
            'status' => $request->status,
            'updated_at' => now(), // Waktu diperbarui saat ini/ Nama pembuat
        ];

        TransaksiCibiru1::where('id_transaksi', $id_transaksi)->update($data);

        if ($data) {
            return redirect()->route('transaksi_cibiru1.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('transaksi_cibiru1.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_transaksi)
    {
        $transaksi_cibiru1 = DB::table('transaksi_cibiru1')->where('id_transaksi', $id_transaksi)->delete();
        if ($transaksi_cibiru1) {
            return redirect('transaksi_cibiru1')->withSuccess('Data Transaksi Kost Cibiru 1 berhasil dihapus.');
        } else {
            return redirect('transaksi_cibiru1')->with('error', 'Data Transaksi Kost Cibiru 1 gagal dihapus.');
        }
    }
}
