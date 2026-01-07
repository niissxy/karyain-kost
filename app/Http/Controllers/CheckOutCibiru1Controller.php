<?php

namespace App\Http\Controllers;

use App\Models\CheckOutCibiru1;
use App\Models\CheckInCibiru1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CheckOutCibiru1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkout_cibiru1 = CheckOutCibiru1::all();
        return view('checkout_cibiru1.index', compact('checkout_cibiru1'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $user = User::all();

  // Ambil id_checkin yang sudah checkout
    $usedCheckin = CheckOutCibiru1::pluck('id_checkin');

    // Ambil checkin yang masih aktif & belum pernah checkout
    $checkin = CheckInCibiru1::where('status', 'Aktif')
        ->whereNotIn('id_checkin', $usedCheckin)
        ->get();

    return view('checkout_cibiru1.create', compact('checkin', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{

   $request->validate([
    'id_checkout' => 'required|string',
    'id_checkin'  => 'required|string|exists:checkin_cibiru1,id_checkin',
    'tgl_checkout'=> 'required|date',
    'nama_penghuni'=> 'required|string',
    'lama_tinggal' => 'required|numeric',
    'no_kamar'     => 'required|string',
    'status'       => 'required|string',
]);


    // Ambil checkin aktif
    $checkin = CheckInCibiru1::where('id_checkin', $request->id_checkin)
        ->where('status', 'Aktif')
        ->first();

    if (!$checkin) {
        return back()->with('error', 'Data checkin tidak valid atau sudah checkout');
    }

    // Hitung lama tinggal
    $lamaTinggal = \Carbon\Carbon::parse($checkin->tgl_checkin)
        ->diffInDays($request->tgl_checkout);

    DB::transaction(function () use ($request, $checkin, $lamaTinggal) {

    CheckOutCibiru1::create([
        'id_checkout'   => $request->id_checkout,
        'id_checkin'    => $checkin->id_checkin,
        'tgl_checkout'  => $request->tgl_checkout,
        'nama_penghuni' => $checkin->nama_penghuni,
        'lama_tinggal'  => $lamaTinggal,
        'no_kamar'      => $checkin->no_kamar,
        'status'        => 'Check out',
    ]);

    $checkin->update([
        'status' => 'Check out'
    ]);

    DB::table('kamar_cibiru1')
        ->where('no_kamar', $checkin->no_kamar)
        ->update(['status_kamar' => 'Kosong']);
});


    return redirect()->route('checkout_cibiru1.index')
        ->with('success', 'Checkout berhasil disimpan');
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
    public function edit(string $id_checkout)
    {
        $user = User::all();
        $checkout_cibiru1 = CheckOutCibiru1::where('id_checkout', $id_checkout)->first();
        return  view('checkout_cibiru1/edit', [
            'user' => $user,
            'checkout_cibiru1' => $checkout_cibiru1
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id_checkout)
{
    $request->validate([
        'tgl_checkout' => 'required|date',
        'lama_tinggal' => 'required|numeric|min:0',
        'status'       => 'required|string'
    ]);

    $checkout = CheckOutCibiru1::where('id_checkout', $id_checkout)
        ->firstOrFail();

    DB::transaction(function () use ($request, $checkout) {

        // Update checkout
        $checkout->update([
            'tgl_checkout' => $request->tgl_checkout,
            'lama_tinggal' => $request->lama_tinggal,
            'status'       => $request->status,
        ]);

        // Pastikan status checkin tetap checkout
        CheckInCibiru1::where('id_checkin', $checkout->id_checkin)
            ->update(['status' => 'Check out']);

        // Pastikan kamar tetap kosong
        DB::table('kamar_cibiru1')
            ->where('no_kamar', $checkout->no_kamar)
            ->update(['status_kamar' => 'Kosong']);
    });

    return redirect()
        ->route('checkout_cibiru1.index')
        ->with('success', 'Data checkout berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_checkout)
    {
        $checkout_cibiru1 = DB::table('checkout_cibiru1')->where('id_checkout', $id_checkout)->delete();
        if ($checkout_cibiru1) {
            return redirect('checkout_cibiru1')->withSuccess('Data Check Out Kost Cibiru 1 berhasil dihapus.');
        } else {
            return redirect('checkout_cibiru1')->with('error', 'Data Check Out Kost Cibiru 1 gagal dihapus.');
        }
    }
}
