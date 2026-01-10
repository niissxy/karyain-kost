<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiRegol1;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiRegol1Controller extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    
    public function index()
    {
        $transaksi_regol1 = TransaksiRegol1::with('user')->get();
        $transaksi_regol1 = TransaksiRegol1::all();
        return view('transaksi_regol1.index', compact('transaksi_regol1'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();

        $lastKode = TransaksiRegol1::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_aset, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'TR-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return view('transaksi_regol1.create', compact('user', 'newKode'));
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
        'no_kamar'           => 'required',
        'nominal'               => 'required|numeric',
        'tgl_pembayaran' => 'required|date',
        'status' => 'required'
        ]);

        $data['user_id'] = Auth::id();

        TransaksiRegol1::create($data);

        return redirect()->route('transaksi_regol1.index')
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
        $transaksi_regol1 = TransaksiRegol1::where('id_transaksi', $id_transaksi)->first();
        return  view('transaksi_regol1/edit', [
            'user' => $user,
            'transaksi_regol1' => $transaksi_regol1
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
            'no_kamar' => $request->no_kamar,
            'nominal' => $request->nominal,
            'tgl_pembayaran' => $request->tgl_pembayaran,
            'status' => $request->status,
            'updated_at' => now(), // Waktu diperbarui saat ini/ Nama pembuat
        ];

        TransaksiRegol1::where('id_transaksi', $id_transaksi)->update($data);

        if ($data) {
            return redirect()->route('transaksi_regol1.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('transaksi_regol1.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_transaksi)
    {
        $transaksi_regol1 = DB::table('transaksi_regol1')->where('id_transaksi', $id_transaksi)->delete();
        if ($transaksi_regol1) {
            return redirect('transaksi_regol1')->withSuccess('Data Transaksi Kost Regol 1 berhasil dihapus.');
        } else {
            return redirect('transaksi_regol1')->with('error', 'Data Transaksi Kost Regol 1 gagal dihapus.');
        }
    }

     public function exportPdf($id_transaksi)
{
    $transaksi = TransaksiRegol1::where('id_transaksi', $id_transaksi)
        ->firstOrFail();

    $pdf = Pdf::loadView(
        'transaksi_regol1.transaksi_pdf',
        compact('transaksi')
    )->setPaper('A4', 'portrait');

    return $pdf->stream('invoice-regol1.pdf');
}
}
