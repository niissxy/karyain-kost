<?php

namespace App\Http\Controllers;

use App\Models\CheckInCibiru2;
use App\Models\KamarCibiru2;
use App\Models\PenghuniCibiru2;
use App\Models\TransaksiCibiru2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CheckInCibiru2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkin_cibiru2 = CheckInCibiru2::all();
        return view('checkin_cibiru2.index', compact('checkin_cibiru2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();

        $lastKode = CheckInCibiru2::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_checkin, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $kamarKosong = KamarCibiru2::where('status_kamar', 'Kosong')
                    ->orderBy('no_kamar', 'asc')
                    ->get();

        $newKode = 'CI-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        return view('checkin_cibiru2.create', compact('user', 'newKode', 'kamarKosong'));
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
        'no_kamar'       => 'required',
        'total_penyewa' => 'required',
        'nominal'        =>'required',
        'metode_pembayaran' => 'required',
        'status'         => 'required', // 'aktif' atau 'booked'
    ]);

    $data['user_id'] = Auth::id();

    // Simpan data check-in
    CheckInCibiru2::create($data);

    // Tentukan status kamar berdasarkan status check-in
    $status_kamar = $data['status'] === 'Aktif' ? 'Terisi' : 'Booked';

    // Update status_kamar di tabel kamar_cibiru1
    DB::table('kamar_cibiru2')
        ->where('no_kamar', $data['no_kamar'])
        ->update(['status_kamar' => $status_kamar]);

    // Jika check-in aktif, tambahkan ke tabel penghuni
    if ($data['status'] === 'Aktif') {
        // Buat id_penghuni (VARCHAR)
        $lastPenghuni = PenghuniCibiru2::latest('id_penghuni')->first();
        $lastNumber = $lastPenghuni ? (int) substr($lastPenghuni->id_penghuni, 3) : 0;
        $newId = 'P-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        PenghuniCibiru2::create([
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

   $lastTransaksi = TransaksiCibiru2::latest('id_transaksi')->first();
        $lastNumber = $lastTransaksi ? (int) substr($lastTransaksi->id_transaksi, 3) : 0;
        $newTransaksiId = 'TR-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        TransaksiCibiru2::create([
            'id_transaksi'  => $newTransaksiId,
            'nama_penyewa'  => $data['nama_penghuni'],
            'total_penyewa' => $data['total_penyewa'],
            'no_kamar'      => $data['no_kamar'],
            'nominal'       => $data['nominal'],
            'metode_pembayaran' => $data['metode_pembayaran'],
            'user_id'       => Auth::id(),
        ]);

    return redirect()->route('checkin_cibiru2.index')
        ->with('success', 'Data check-in berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_checkin)
    {
    //     $checkin_cibiru2 = CheckInCibiru2::where('id_checkin', $id_checkin)->firstOrFail();
    //    return view('checkin_cibiru2.show', compact('checkin_cibiru2'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_checkin)
    {
        $user = User::all();
        $checkin_cibiru2 = CheckInCibiru2::where('id_checkin', $id_checkin)->first();
        return  view('checkin_cibiru2/edit', [
            'user' => $user,
            'checkin_cibiru2' => $checkin_cibiru2
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, string $id_checkin) {
    $request->validate([
        'tgl_checkin' => 'required|date',
        'jam_checkin' => 'required',
        'tgl_checkout' => 'nullable|date',
        'jam_checkout' => 'nullable',
        'nama_penghuni' => 'required',
        'no_kamar' => 'required',
        'total_penyewa' => 'required',
        'nominal' => 'required',
        'metode_pembayaran' => 'required',
        'status' => 'required',
    ]);

    DB::transaction(function () use ($request, $id_checkin) {

        // ambil data lama
        $checkin = CheckInCibiru2::where('id_checkin', $id_checkin)->firstOrFail();

        $namaLama = $checkin->nama_penghuni;
        $noKamarLama = $checkin->no_kamar;

        // ================= UPDATE CHECKIN =================
        $checkin->update([
            'tgl_checkin'   => $request->tgl_checkin,
            'tgl_checkout'  => $request->tgl_checkout,
            'jam_checkin'   => $request->jam_checkin,
            'jam_checkout'  => $request->jam_checkout,
            'nama_penghuni' => $request->nama_penghuni,
            'no_kamar'      => $request->no_kamar,
            'total_penyewa' => $request->total_penyewa,
            'nominal'       => str_replace('.', '', $request->nominal),
            'metode_pembayaran' => $request->metode_pembayaran,
            'status'        => $request->status,
        ]);

        // ================= UPDATE PENGHUNI (JIKA MASIH AKTIF) =================
        PenghuniCibiru2::where('nama_penghuni', $namaLama)
            ->where('penempatan_kamar', $noKamarLama)
            ->where('status', 'Masih di kost')
            ->update([
                'nama_penghuni' => $request->nama_penghuni,
                'penempatan_kamar' => $request->no_kamar,
            ]);

        // ================= JIKA CHECK OUT =================
        if ($request->status === 'Check out') {

            $tglCheckout = $request->tgl_checkout ?? Carbon::now()->toDateString();
            $jamCheckout = $request->jam_checkout;

            $start = Carbon::parse($checkin->tgl_checkin);
            $end   = Carbon::parse($tglCheckout);

            $diff = $start->diff($end);

            $bulan = $diff->m;
            $hari  = $diff->d;

            if ($bulan > 0 && $hari > 0) {
                $lamaTinggal = $bulan . ' Bulan ' . $hari . ' Hari';
            } elseif ($bulan > 0) {
                $lamaTinggal = $bulan . ' Bulan';
            } else {
                $lamaTinggal = $hari . ' Hari';
            }

            // buat id checkout
            $lastCheckout = DB::table('checkout_cibiru2')->latest('id_checkout')->first();
            $lastNumber = $lastCheckout ? (int) substr($lastCheckout->id_checkout, 3) : 0;
            $newCheckoutId = 'CO-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

            // cek sudah checkout atau belum
            $cekCheckout = DB::table('checkout_cibiru2')
                ->where('id_checkin', $checkin->id_checkin)
                ->first();

            if (!$cekCheckout) {
                DB::table('checkout_cibiru2')->insert([
                    'id_checkout'   => $newCheckoutId,
                    'id_checkin'    => $checkin->id_checkin,
                    'tgl_checkout'  => $tglCheckout,
                    'jam_checkout'  => $jamCheckout,
                    'nama_penghuni' => $request->nama_penghuni,
                    'lama_tinggal'  => $lamaTinggal,
                    'no_kamar'      => $request->no_kamar,
                    'status'        => 'Check out',
                    'user_id'       => Auth::id(),
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }

            // update kamar jadi Kosong
            DB::table('kamar_cibiru2')
                ->where('no_kamar', $noKamarLama)
                ->update(['status_kamar' => 'Kosong']);

            DB::table('lap_kamar_cibiru2')
                ->where('no_kamar', $noKamarLama)
                ->update(['status_kamar' => 'Kosong']);

            // update penghuni jadi Keluar kost
            PenghuniCibiru2::where('nama_penghuni', $request->nama_penghuni)
                ->where('penempatan_kamar', $request->no_kamar)
                ->where('status', 'Masih di kost')
                ->update([
                    'status' => 'Keluar kost',
                    'tgl_keluar' => $tglCheckout
                ]);
        }

        // ================= JIKA BUKAN CHECK OUT =================
        else {

            $status_kamar = $request->status === 'Aktif' ? 'Terisi' : 'Booked';

            DB::table('kamar_cibiru2')
                ->where('no_kamar', $request->no_kamar)
                ->update(['status_kamar' => $status_kamar]);

            DB::table('lap_kamar_cibiru2')
                ->where('no_kamar', $request->no_kamar)
                ->update(['status_kamar' => $status_kamar]);
        }
    });

    return redirect()->route('checkin_cibiru2.index')
        ->with('success', 'Data check-in berhasil diperbarui');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_checkin)
    {
        $checkin_cibiru2 = DB::table('checkin_cibiru2')->where('id_checkin', $id_checkin)->delete();
        if ($checkin_cibiru2) {
            return redirect('checkin_cibiru2')->withSuccess('Data Check In Kost Cibiru 2 berhasil dihapus.');
        } else {
            return redirect('checkin_cibiru2')->with('error', 'Data Check In Kost Cibiru 2 gagal dihapus.');
        }
    }

     public function exportPdf($id_checkin)
{
    $checkin_cibiru2 = CheckinCibiru2::where('id_checkin', $id_checkin)
        ->firstOrFail();

    $pdf = Pdf::loadView(
        'checkin_cibiru2.checkin_pdf',
        compact('checkin_cibiru2')
    )->setPaper('A4', 'portrait');

    return $pdf->stream('checkin-cibiru2.pdf');
}
}
