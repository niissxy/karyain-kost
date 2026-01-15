<?php

namespace App\Http\Controllers;

use App\Models\CheckInRegol1;
use App\Models\PenghuniRegol1;
use App\Models\KamarRegol1;
use App\Models\TransaksiRegol1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckInRegol1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkin_regol1 = CheckInregol1::all();
        return view('checkin_regol1.index', compact('checkin_regol1'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();

        $lastKode = CheckInRegol1::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_checkin, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $kamarKosong = KamarRegol1::where('status_kamar', 'Kosong')
                    ->orderBy('no_kamar', 'asc')
                    ->get();

        $newKode = 'CI-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        return view('checkin_regol1.create', compact('user', 'newKode', 'kamarKosong'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'id_checkin'     => 'required',
        'tgl_checkin'    => 'required|date',
        'nama_penghuni'  => 'required',
        'nominal'        =>'required',
        'metode_pembayaran' => 'required',
        'no_kamar'       => 'required',
        'status'         => 'required', // 'aktif' atau 'booked'
    ]);

    $data['user_id'] = Auth::id();

    // Simpan data check-in
    CheckInRegol1::create($data);

    // Tentukan status kamar berdasarkan status check-in
    $status_kamar = $data['status'] === 'Aktif' ? 'Terisi' : 'Booked';

    // Update status_kamar di tabel kamar_cibiru1
    DB::table('kamar_regol1')
        ->where('no_kamar', $data['no_kamar'])
        ->update(['status_kamar' => $status_kamar]);

    // Jika check-in aktif, tambahkan ke tabel penghuni
    if ($data['status'] === 'Aktif') {
        // Buat id_penghuni (VARCHAR)
        $lastPenghuni = PenghuniRegol1::latest('id_penghuni')->first();
        $lastNumber = $lastPenghuni ? (int) substr($lastPenghuni->id_penghuni, 3) : 0;
        $newId = 'P-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        PenghuniRegol1::create([
            'id_penghuni'      => $newId,
            'nama_penghuni'    => $data['nama_penghuni'],
            'penempatan_kamar' => $data['no_kamar'],
            'tgl_masuk'        => $data['tgl_checkin'],
            'status'           => 'Masih di kost',
            'user_id'          => Auth::id(),
            'alamat'           => null,
            'kontak'           => null,
            'tgl_keluar'       => null,
        ]);
    }

   $lastTransaksi = TransaksiRegol1::latest('id_transaksi')->first();
        $lastNumber = $lastTransaksi ? (int) substr($lastTransaksi->id_transaksi, 3) : 0;
        $newTransaksiId = 'TR-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        TransaksiRegol1::create([
            'id_transaksi'  => $newTransaksiId,
            'nama_penyewa'  => $data['nama_penghuni'],
            'no_kamar'      => $data['no_kamar'],
            'nominal'       => $data['nominal'],
            'metode_pembayaran' => $data['metode_pembayaran'],
            'user_id'       => Auth::id(),
        ]);

    return redirect()->route('checkin_regol1.index')
        ->with('success', 'Data berhasil ditambahkan dan status kamar diperbarui');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_checkin)
    {
    //     $checkin_regol1 = CheckInRegol1::where('id_checkin', $id_checkin)->firstOrFail();
    //    return view('checkin_regol1.show', compact('checkin_regol1'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_checkin)
    {
        $user = User::all();
        $checkin_regol1 = CheckInRegol1::where('id_checkin', $id_checkin)->first();
        return  view('checkin_regol1/edit', [
            'user' => $user,
            'checkin_regol1' => $checkin_regol1
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, string $id_checkin)
{
    DB::transaction(function () use ($request, $id_checkin) {

        $checkin = CheckInRegol1::where('id_checkin', $id_checkin)->firstOrFail();

        // Update check-in
        $checkin->update([
            'tgl_checkin'   => $request->tgl_checkin,
            'nama_penghuni' => $request->nama_penghuni,
            'no_kamar'      => $request->no_kamar,
            'nominal'       => str_replace('.', '', $request->nominal),
            'metode_pembayaran' => $request->metode_pembayaran,
            'status'        => $request->status,
        ]);

        // ================= STATUS KAMAR =================
        $status_kamar = $request->status === 'Aktif' ? 'Terisi' : 'Booked';
        DB::table('kamar_regol1')
            ->where('no_kamar', $request->no_kamar)
            ->update(['status_kamar' => $status_kamar]);

        DB::table('lap_kamar_regol1')
            ->where('no_kamar', $request->no_kamar)
            ->update(['status_kamar' => $status_kamar]);

        // ================= PENGHUNI =================
        $penghuni = PenghuniRegol1::where('nama_penghuni', $checkin->nama_penghuni)
            ->where('penempatan_kamar', $checkin->no_kamar)
            ->where('status', 'Masih di kost')
            ->first();

        // Jika ada, update tanggal masuk
        if ($penghuni) {
            $penghuni->update([
                'tgl_masuk' => $request->tgl_checkin
            ]);

            DB::table('lap_penghuni_regol1')
                ->where('id_penghuni', $penghuni->id_penghuni)
                ->update([
                    'tgl_masuk' => $request->tgl_checkin
                ]);
        }
        // Jika belum ada penghuni dan status sekarang Aktif → buat data penghuni baru
        elseif ($request->status === 'Aktif') {
            $userId = Auth::id() ?? 1; // default user_id jika null

            // Buat id_penghuni baru
            $lastPenghuni = PenghuniRegol1::latest('id_penghuni')->first();
            $lastNumber = $lastPenghuni ? (int) substr($lastPenghuni->id_penghuni, 3) : 0;
            $newId = 'P-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

            PenghuniRegol1::create([
                'id_penghuni'      => $newId,
                'nama_penghuni'    => $request->nama_penghuni,
                'penempatan_kamar' => $request->no_kamar,
                'tgl_masuk'        => $request->tgl_checkin,
                'status'           => 'Masih di kost',
                'user_id'          => $userId,
                'alamat'           => null,
                'kontak'           => null,
                'tgl_keluar'       => null,
            ]);
        }

        // ================= TRANSAKSI =================
        $transaksi = TransaksiRegol1::where('no_kamar', $checkin->no_kamar)
            ->where('nama_penyewa', $checkin->nama_penghuni)
            ->latest()
            ->first();

        if ($transaksi) {
            $transaksi->update([
                'nominal' => str_replace('.', '', $request->nominal)
            ]);

            DB::table('lap_transaksi_regol1')
                ->where('id_transaksi', $transaksi->id_transaksi)
                ->update([
                    'nominal' => str_replace('.', '', $request->nominal)
                ]);
        }
    });

    return redirect()->route('checkin_regol1.index')
        ->with('success', 'Data berhasil diperbarui');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_checkin)
    {
        $checkin_regol1 = DB::table('checkin_regol1')->where('id_checkin', $id_checkin)->delete();
        if ($checkin_regol1) {
            return redirect('checkin_regol1')->withSuccess('Data Check In Kost Regol 1 berhasil dihapus.');
        } else {
            return redirect('checkin_regol1')->with('error', 'Data Check In Kost Regol 1 gagal dihapus.');
        }
    }

     public function exportPdf($id_checkin)
{
    $checkin_regol1 = CheckinRegol1::where('id_checkin', $id_checkin)
        ->firstOrFail();

    $pdf = Pdf::loadView(
        'checkin_regol1.checkin_pdf',
        compact('checkin_regol1')
    )->setPaper('A4', 'portrait');

    return $pdf->stream('checkin-regol1.pdf');
}
}
