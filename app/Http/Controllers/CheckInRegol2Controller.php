<?php

namespace App\Http\Controllers;

use App\Models\CheckInRegol2;
use App\Models\PenghuniRegol2;
use App\Models\KamarRegol2;
use App\Models\TransaksiRegol2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

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

        $kamarKosong = KamarRegol2::where('status_kamar', 'Kosong')
                    ->orderBy('no_kamar', 'asc')
                    ->get();

        $newKode = 'CI-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        return view('checkin_regol2.create', compact('user', 'newKode', 'kamarKosong'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data = $request->validate([
        'id_checkin'     => 'required',
        'tgl_checkin'    => 'required|date',
        'tgl_checkout' => 'nullable|date',
        'jam_checkin' => 'required',
        'jam_checkout' => 'nullable',
        'nama_penghuni'  => 'required',
        'nominal'        => 'required',
        'metode_pembayaran' => 'required',
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
            'nominal'       => $data['nominal'],
            'metode_pembayaran' => $data['metode_pembayaran'],
            'user_id'       => Auth::id(),
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
    $request->validate([
        'status' => 'required',
        'tgl_checkout' => 'nullable|date'
    ]);

    DB::transaction(function () use ($request, $id_checkin) {

        $checkin = CheckInRegol2::where('id_checkin', $id_checkin)->firstOrFail();

        // update data checkin dulu
        $checkin->update([
            'tgl_checkin'   => $request->tgl_checkin,
            'tgl_checkout'  => $request->tgl_checkout,
            'jam_checkin'   => $request->jam_checkin,
            'jam_checkout'  => $request->jam_checkout,
            'nama_penghuni' => $request->nama_penghuni,
            'no_kamar'      => $request->no_kamar,
            'nominal'       => str_replace('.', '', $request->nominal),
            'metode_pembayaran' => $request->metode_pembayaran,
            'status'        => $request->status,
        ]);

        // ================= JIKA CHECKOUT =================
        if ($request->status === 'Check out') {

            $tglCheckout = $request->tgl_checkout ?? Carbon::now()->toDateString();

            $lamaTinggal = Carbon::parse($checkin->tgl_checkin)
                ->diffInDays(Carbon::parse($tglCheckout));

            // buat id checkout
            $lastCheckout = DB::table('checkout_regol2')->latest('id_checkout')->first();
            $lastNumber = $lastCheckout ? (int) substr($lastCheckout->id_checkout, 3) : 0;
            $newCheckoutId = 'CO-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

            // insert checkout (hindari dobel)
            $cekCheckout = DB::table('checkout_regol2')
                ->where('id_checkin', $checkin->id_checkin)
                ->first();

            if (!$cekCheckout) {
                DB::table('checkout_regol2')->insert([
                    'id_checkout'   => $newCheckoutId,
                    'id_checkin'    => $checkin->id_checkin,
                    'nama_penghuni' => $checkin->nama_penghuni,
                    'no_kamar'      => $checkin->no_kamar,
                    'tgl_checkout'  => $tglCheckout,
                    'lama_tinggal'  => $lamaTinggal,
                    'user_id'       => Auth::id(),
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }

            // update kamar jadi Kosong
            DB::table('kamar_regol2')
                ->where('no_kamar', $checkin->no_kamar)
                ->update(['status_kamar' => 'Kosong']);

            DB::table('lap_kamar_regol2')
                ->where('no_kamar', $checkin->no_kamar)
                ->update(['status_kamar' => 'Kosong']);

            // update penghuni jadi Keluar kost
            PenghuniRegol2::where('nama_penghuni', $checkin->nama_penghuni)
                ->where('penempatan_kamar', $checkin->no_kamar)
                ->where('status', 'Masih di kost')
                ->update([
                    'status' => 'Keluar kost',
                    'tgl_keluar' => $tglCheckout
                ]);

        }
        // ================= JIKA BUKAN CHECKOUT =================
        else {

            $status_kamar = $request->status === 'Aktif' ? 'Terisi' : 'Booked';

            DB::table('kamar_regol2')
                ->where('no_kamar', $request->no_kamar)
                ->update(['status_kamar' => $status_kamar]);

            DB::table('lap_kamar_regol2')
                ->where('no_kamar', $request->no_kamar)
                ->update(['status_kamar' => $status_kamar]);
        }

    });

    return redirect()->route('checkin_regol2.index')
        ->with('success', 'Data berhasil diperbarui');
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

     public function exportPdf($id_checkin)
{
    $checkin_regol2 = CheckinRegol2::where('id_checkin', $id_checkin)
        ->firstOrFail();

    $pdf = Pdf::loadView(
        'checkin_regol2.checkin_pdf',
        compact('checkin_regol2')
    )->setPaper('A4', 'portrait');

    return $pdf->stream('checkin-regol2.pdf');
}
}
