<?php

namespace App\Http\Controllers;

use App\Models\CheckInRegol2;
use App\Models\PenghuniRegol2;
use App\Models\TransaksiRegol2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckInRegol2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkin_regol2 = CheckInregol2::all();
        return view('checkin_regol2.index', compact('checkin_regol2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();

        $lastKode = CheckInRegol2::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_checkin, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'CI-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        return view('checkin_regol2.create', compact('user', 'newKode'));
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
        'no_kamar'       => 'required',
        'status'         => 'required', // 'aktif' atau 'booked'
    ]);

    $data['user_id'] = Auth::id();

    // Simpan data check-in
    CheckInRegol2::create($data);

    // Tentukan status kamar berdasarkan status check-in
    $status_kamar = $data['status'] === 'Aktif' ? 'Terisi' : 'Booked';

    // Update status_kamar di tabel kamar_cibiru1
    DB::table('kamar_regol2')
        ->where('no_kamar', $data['no_kamar'])
        ->update(['status_kamar' => $status_kamar]);

     // Jika check-in aktif, tambahkan ke tabel penghuni
    if ($data['status'] === 'Aktif') {
        // Buat id_penghuni (VARCHAR)
        $lastPenghuni = PenghuniRegol2::latest('id_penghuni')->first();
        $lastNumber = $lastPenghuni ? (int) substr($lastPenghuni->id_penghuni, 3) : 0;
        $newId = 'P-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        PenghuniRegol2::create([
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

   $lastTransaksi = TransaksiRegol2::latest('id_transaksi')->first();
        $lastNumber = $lastTransaksi ? (int) substr($lastTransaksi->id_transaksi, 3) : 0;
        $newTransaksiId = 'TR-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        TransaksiRegol2::create([
            'id_transaksi'  => $newTransaksiId,
            'nama_penyewa'  => $data['nama_penghuni'],
            'no_kamar'      => $data['no_kamar'],
            'user_id'          => Auth::id(),
        ]);

    return redirect()->route('checkin_regol2.index')
        ->with('success', 'Data berhasil ditambahkan dan status kamar diperbarui');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_checkin)
    {
        $checkin_regol2 = CheckInRegol2::where('id_checkin', $id_checkin)->firstOrFail();
       return view('checkin_regol2.show', compact('checkin_regol2'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_checkin)
    {
        $user = User::all();
        $checkin_regol2 = CheckInRegol2::where('id_checkin', $id_checkin)->first();
        return  view('checkin_regol2/edit', [
            'user' => $user,
            'checkin_regol2' => $checkin_regol2
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id_checkin)
    {
    DB::transaction(function () use ($request, $id_checkin) {

        // Ambil data checkin lama
        $checkin = CheckInRegol2::where('id_checkin', $id_checkin)->firstOrFail();

        // =========================
        // UPDATE CHECKIN
        // =========================
        $data = [
            'tgl_checkin'   => $request->tgl_checkin,
            'nama_penghuni' => $request->nama_penghuni,
            'no_kamar'      => $request->no_kamar,
            'status'        => $request->status,
        ];

        $checkin->update($data);

        // =========================
        // UPDATE STATUS KAMAR
        // =========================
        $status_kamar = $request->status === 'Aktif' ? 'Terisi' : 'Booked';

        DB::table('kamar_cibiru1')
            ->where('no_kamar', $request->no_kamar)
            ->update(['status_kamar' => $status_kamar]);

        // =========================
        // UPDATE PENGHUNI
        // =========================
        $penghuni = PenghuniRegol2::where('nama_penghuni', $checkin->nama_penghuni)
            ->where('penempatan_kamar', $checkin->no_kamar)
            ->where('status', 'Masih di kost')
            ->first();

        if ($penghuni) {
            // update tgl_masuk di penghuni
            $penghuni->update([
                'tgl_masuk' => $request->tgl_checkin
            ]);

            // update tgl_masuk di laporan penghuni
            DB::table('lap_penghuni_regol2')
                ->where('id_penghuni', $penghuni->id_penghuni)
                ->update([
                    'tgl_masuk' => $request->tgl_checkin
                ]);
        }

    });

    return redirect()->route('checkin_regol2.index')
        ->with('success', 'Data berhasil diperbarui dan status kamar diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_checkin)
    {
        $checkin_regol2 = DB::table('checkin_regol2')->where('id_checkin', $id_checkin)->delete();
        if ($checkin_regol2) {
            return redirect('checkin_regol2')->withSuccess('Data Check In Kost Regol 2 berhasil dihapus.');
        } else {
            return redirect('checkin_regol2')->with('error', 'Data Check In Kost Regol 2 gagal dihapus.');
        }
    }
}
