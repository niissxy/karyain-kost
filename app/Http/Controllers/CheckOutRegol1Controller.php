<?php

namespace App\Http\Controllers;

use App\Models\CheckOutRegol1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CheckOutRegol1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkout_regol1 = CheckOutRegol1::all();
        return view('checkout_regol1.index', compact('checkout_regol1'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        return view('checkout_regol1.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'id_checkout'     => 'required',
        'id_checkin'    => 'required',
        'tgl_checkout'   => 'required|date',
        'nama_penghuni'     => 'required',
        'lama_tinggal' => 'required',
        'no_kamar' => 'required',
        'status'        => 'required ',
        ]);

        CheckOutRegol1::create($data);

        return redirect()->route('checkout_regol1.index')
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
    public function edit(string $id_checkout)
    {
        $user = User::all();
        $checkout_regol1 = CheckOutRegol1::where('id_checkout', $id_checkout)->first();
        return  view('checkout_regol1/edit', [
            'user' => $user,
            'checkout_regol1' => $checkout_regol1
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_checkout)
    {
        $data = [
            'id_checkout' => $request->id_checkout,
            'id_checkin' => $request->id_checkin,
            'tgl_checkout' => $request->tgl_checkout,
            'nama_penghuni' => $request->nama_penghuni,
            'lama_tinggal' => $request->lama_tinggal,
            'no_kamar' => $request->no_kamar,
            'status' => $request->status,
        ];

        CheckOutRegol1::where('id_checkout', $id_checkout)->update($data);

        if ($data) {
            return redirect()->route('checkout_regol1.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('checkout_regol1.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_checkout)
    {
        $checkout_regol1 = DB::table('checkout_regol1')->where('id_checkout', $id_checkout)->delete();
        if ($checkout_regol1) {
            return redirect('checkout_regol1')->withSuccess('Data Check Out Kost Regol 1 berhasil dihapus.');
        } else {
            return redirect('checkout_regol1')->with('error', 'Data Check Out Kost Regol 1 gagal dihapus.');
        }
    }
}
