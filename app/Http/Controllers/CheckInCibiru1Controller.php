<?php

namespace App\Http\Controllers;

use App\Models\CheckInCibiru1;
use App\Models\PenghuniCibiru1;
use App\Models\TransaksiCibiru1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Psy\ManualUpdater\Checker;

class CheckInCibiru1Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $checkin_cibiru1 = CheckInCibiru1::all();
        return view('checkin_cibiru1.index', compact('checkin_cibiru1'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();

        $lastKode = CheckInCibiru1::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_checkin, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'CI-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        return view('checkin_cibiru1.create', compact('user', 'newKode'));
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
        'status'         => 'required', // 'Aktif' atau 'Booked'
    ]);

    $data['user_id'] = Auth::id();

    // Simpan data check-in
    CheckInCibiru1::create($data);

    // Update status kamar
    $status_kamar = $data['status'] === 'Aktif' ? 'Terisi' : 'Booked';
    DB::table('kamar_cibiru1')
        ->where('no_kamar', $data['no_kamar'])
        ->update(['status_kamar' => $status_kamar]);

    // Jika check-in aktif, tambahkan ke tabel penghuni
    if ($data['status'] === 'Aktif') {
        // Buat id_penghuni (VARCHAR)
        $lastPenghuni = PenghuniCibiru1::latest('id_penghuni')->first();
        $lastNumber = $lastPenghuni ? (int) substr($lastPenghuni->id_penghuni, 3) : 0;
        $newId = 'P-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        PenghuniCibiru1::create([
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

   $lastTransaksi = TransaksiCibiru1::latest('id_transaksi')->first();
        $lastNumber = $lastTransaksi ? (int) substr($lastTransaksi->id_transaksi, 3) : 0;
        $newTransaksiId = 'TR-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        TransaksiCibiru1::create([
            'id_transaksi'  => $newTransaksiId,
            'nama_penyewa'  => $data['nama_penghuni'],
            'no_kamar'      => $data['no_kamar'],
            'user_id'          => Auth::id(),
        ]);

    return redirect()->route('checkin_cibiru1.index')
        ->with('success', 'Check-in berhasil dan penghuni diperbarui');
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
    public function edit(string $id_checkin)
    {
        $user = User::all();
        $checkin_cibiru1 = CheckInCibiru1::where('id_checkin', $id_checkin)->first();
        return  view('checkin_cibiru1/edit', [
            'user' => $user,
            'checkin_cibiru1' => $checkin_cibiru1
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_checkin)
    {
    $data = [
        'id_checkin'    => $request->id_checkin,
        'tgl_checkin'   => $request->tgl_checkin,
        'nama_penghuni' => $request->nama_penghuni,
        'no_kamar'      => $request->no_kamar,
        'status'        => $request->status, // 'aktif' atau 'booked'
    ];

    CheckInCibiru1::where('id_checkin', $id_checkin)->update($data);

    // Update status_kamar sesuai status check-in
    $status_kamar = $data['status'] === 'Aktif' ? 'Terisi' : 'Booked';

    DB::table('kamar_cibiru1')
        ->where('no_kamar', $data['no_kamar'])
        ->update(['status_kamar' => $status_kamar]);

    return redirect()->route('checkin_cibiru1.index')
        ->with('success', 'Data berhasil diperbarui dan status kamar diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_checkin)
    {
        $checkin_cibiru1 = DB::table('checkin_cibiru1')->where('id_checkin', $id_checkin)->delete();
        if ($checkin_cibiru1) {
            return redirect('checkin_cibiru1')->withSuccess('Data Check In Kost Cibiru 1 berhasil dihapus.');
        } else {
            return redirect('checkin_cibiru1')->with('error', 'Data Check In Kost Cibiru 1 gagal dihapus.');
        }
    }
}
