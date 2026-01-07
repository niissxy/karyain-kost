<?php

namespace App\Http\Controllers;

use App\Models\CheckInCibiru1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CheckInCibiru1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        return view('checkin_cibiru1.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'id_checkin'     => 'required',
        'tgl_checkin'   => 'required|date',
        'nama_penghuni'     => 'required',
        'lama_tinggal' => 'required',
        'no_kamar' => 'required',
        'status'        => 'required ',
        ]);

        CheckInCibiru1::create($data);

        return redirect()->route('checkin_cibiru1.index')
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
            'id_checkin' => $request->id_checkin,
            'tgl_checkin' => $request->tgl_checkin,
            'nama_penghuni' => $request->nama_penghuni,
            'lama_tinggal' => $request->lama_tinggal,
            'no_kamar' => $request->no_kamar,
            'status' => $request->status,
        ];

        CheckInCibiru1::where('id_checkin', $id_checkin)->update($data);

        if ($data) {
            return redirect()->route('checkin_cibiru1.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('checkin_cibiru1.index')->with('error', 'Data gagal diperbarui');
        }
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
