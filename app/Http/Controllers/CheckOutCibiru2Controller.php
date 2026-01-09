<?php

namespace App\Http\Controllers;

use App\Models\CheckOutCibiru2;
use App\Models\CheckInCibiru2;
use App\Models\PenghuniCibiru2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckOutCibiru2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $checkout_cibiru2 = CheckOutCibiru2::with('user')->get();
        return view('checkout_cibiru2.index', compact('checkout_cibiru2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();

        $lastKode = CheckOutCibiru2::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_checkout, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'CO-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

  // Ambil id_checkin yang sudah checkout
    $usedCheckin = CheckOutCibiru2::pluck('id_checkin');

    // Ambil checkin yang masih aktif & belum pernah checkout
    $checkin = CheckInCibiru2::where('status', 'Aktif')
        ->whereNotIn('id_checkin', $usedCheckin)
        ->get();

    return view('checkout_cibiru2.create', compact('checkin', 'user', 'newKode'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'id_checkout' => 'required|string',
        'id_checkin'  => 'required|string|exists:checkin_cibiru2,id_checkin',
        'tgl_checkout'=> 'required|date',
        'nama_penghuni'=> 'required|string',
        'no_kamar'     => 'required|string',
        'status'       => 'required|string',
    ]);

    // AMBIL CHECKIN DULU
    $checkin = CheckInCibiru2::where('id_checkin', $request->id_checkin)
        ->where('status', 'Aktif')
        ->first();

    // ❗ JIKA TIDAK DITEMUKAN
    if (!$checkin) {
        return back()->with('error', 'Data check-in tidak valid atau sudah checkout');
    }

    // ===============================
    // HITUNG LAMA TINGGAL (BULAN + HARI)
    // ===============================
    $checkinDate  = \Carbon\Carbon::parse($checkin->tgl_checkin);
    $checkoutDate = \Carbon\Carbon::parse($request->tgl_checkout);

    if ($checkoutDate->lt($checkinDate)) {
        return back()->with('error', 'Tanggal checkout tidak boleh lebih kecil dari checkin');
    }

    $totalHari = $checkinDate->diffInDays($checkoutDate);

    $bulan = intdiv($totalHari, 30);
    $hari  = $totalHari % 30;

    if ($bulan > 0 && $hari > 0) {
        $lamaTinggal = "$bulan Bulan $hari Hari";
    } elseif ($bulan > 0) {
        $lamaTinggal = "$bulan Bulan";
    } else {
        $lamaTinggal = "$hari Hari";
    }

    // ===============================
    // TRANSAKSI DATABASE
    // ===============================
   DB::transaction(function () use ($request, $checkin, $lamaTinggal) {

    CheckOutCibiru2::create([
        'id_checkout'   => $request->id_checkout,
        'id_checkin'    => $checkin->id_checkin,
        'tgl_checkout'  => $request->tgl_checkout,
        'nama_penghuni' => $checkin->nama_penghuni,
        'lama_tinggal'  => $lamaTinggal,
        'no_kamar'      => $checkin->no_kamar,
        'status'        => 'Check out',
        'user_id'       => Auth::id(),
    ]);

    // update status checkin
    $checkin->update([
        'status' => 'Check out'
    ]);

    // update status kamar
    DB::table('kamar_cibiru2')
        ->where('no_kamar', $checkin->no_kamar)
        ->update(['status_kamar' => 'Kosong']);

    // update status penghuni
    PenghuniCibiru2::where('nama_penghuni', $checkin->nama_penghuni)
            ->where('penempatan_kamar', $checkin->no_kamar)
            ->update([
                'status'     => 'Keluar kost',
                'tgl_keluar' => $request->tgl_checkout
    ]);
    
    // ambil id_penghuni DARI TABEL PENGHUNI
$penghuni = PenghuniCibiru2::where('nama_penghuni', $checkin->nama_penghuni)
    ->where('penempatan_kamar', $checkin->no_kamar)
    ->first();

// update laporan penghuni
if ($penghuni) {
    DB::table('lap_penghuni_cibiru2')
        ->where('id_penghuni', $penghuni->id_penghuni)
        ->update([
            'tgl_keluar'      => $request->tgl_checkout,
            'status_penghuni' => 'Keluar kost',
        ]);
}
});

    return redirect()->route('checkout_cibiru2.index')
        ->with('success', 'Checkout berhasil disimpan');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id_checkout)
    {
        $checkout_cibiru2 = CheckOutCibiru2::where('id_checkout', $id_checkout)->firstOrFail();
        return view('checkout_cibiru2.show',compact('checkout_cibiru2'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_checkout)
    {
        $user = User::all();
        $checkout_cibiru2 = CheckOutCibiru2::where('id_checkout', $id_checkout)->first();
        return  view('checkout_cibiru2/edit', [
            'user' => $user,
            'checkout_cibiru2' => $checkout_cibiru2
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_checkout)
    {
    $request->validate([
        'tgl_checkout' => 'required|date',
        'status'       => 'required|string'
    ]);

    $checkout = CheckOutCibiru2::where('id_checkout', $id_checkout)
        ->firstOrFail();

    $checkin = CheckInCibiru2::where('id_checkin', $checkout->id_checkin)->first();

    if (!$checkin) {
        return back()->with('error', 'Data check-in tidak ditemukan');
    }

    // ===============================
    // HITUNG LAMA TINGGAL (STRING)
    // ===============================
    $checkinDate  = \Carbon\Carbon::parse($checkin->tgl_checkin);
    $checkoutDate = \Carbon\Carbon::parse($request->tgl_checkout);

    if ($checkoutDate->lt($checkinDate)) {
        return back()->with('error', 'Tanggal checkout tidak boleh lebih kecil dari checkin');
    }

    $totalHari = $checkinDate->diffInDays($checkoutDate);

    $bulan = intdiv($totalHari, 30);
    $hari  = $totalHari % 30;

    if ($bulan > 0 && $hari > 0) {
        $lamaTinggal = "$bulan Bulan $hari Hari";
    } elseif ($bulan > 0) {
        $lamaTinggal = "$bulan Bulan";
    } else {
        $lamaTinggal = "$hari Hari";
    }

    // ===============================
    // TRANSAKSI
    // ===============================
    DB::transaction(function () use ($request, $checkout, $lamaTinggal) {

        $checkout->update([
            'tgl_checkout' => $request->tgl_checkout,
            'lama_tinggal' => $lamaTinggal, // STRING
            'status'       => $request->status,
            'user_id'      => Auth::id(),
        ]);

        CheckInCibiru2::where('id_checkin', $checkout->id_checkin)
            ->update(['status' => 'Check out']);

        DB::table('kamar_cibiru2')
            ->where('no_kamar', $checkout->no_kamar)
            ->update(['status_kamar' => 'Kosong']);

             //Update tabel penghuni
        $penghuni = PenghuniCibiru2::where('penempatan_kamar', $checkout->no_kamar)
            ->where('nama_penghuni', $checkout->nama_penghuni)
            ->first();

        if ($penghuni) {
            $penghuni->update([
                'tgl_keluar' => $request->tgl_checkout,
                'status'     => 'Keluar Kost',
            ]);
        }

       if ($penghuni) {
        DB::table('lap_penghuni_cibiru2')
        ->where('id_penghuni', $penghuni->id_penghuni)
        ->update([
            'tgl_keluar' => $request->tgl_checkout,
            'status_penghuni'     => 'Keluar kost',
        ]);
}
    });


    return redirect()
        ->route('checkout_cibiru2.index')
        ->with('success', 'Data checkout berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_checkout)
    {
        $checkout_cibiru2 = DB::table('checkout_cibiru2')->where('id_checkout', $id_checkout)->delete();
        if ($checkout_cibiru2) {
            return redirect('checkout_cibiru2')->withSuccess('Data Check Out Kost Cibiru 2 berhasil dihapus.');
        } else {
            return redirect('checkout_cibiru2')->with('error', 'Data Check Out Kost Cibiru 2 gagal dihapus.');
        }
    }
}
