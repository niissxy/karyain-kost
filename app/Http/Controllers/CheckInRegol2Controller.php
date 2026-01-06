<?php

namespace App\Http\Controllers;

use App\Models\CheckInRegol2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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
        return view('checkin_regol2.create', compact('user'));
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
        'status'        => 'required ',
        ]);

        CheckInRegol2::create($data);

        return redirect()->route('checkin_regol2.index')
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
        $checkin_regol2 = CheckInRegol2::where('id_checkin', $id_checkin)->first();
        return  view('checkin_regol2/edit', [
            'user' => $user,
            'checkin_cibiru2' => $checkin_regol2
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
            'status' => $request->status,
        ];

        CheckInRegol2::where('id_checkin', $id_checkin)->update($data);

        if ($data) {
            return redirect()->route('checkin_regol2.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('checkin_regol2.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_checkin)
    {
        $checkin_regol2 = DB::table('checkin_regol1')->where('id_checkin', $id_checkin)->delete();
        if ($checkin_regol2) {
            return redirect('checkin_regol2')->withSuccess('Data Check In Kost Regol 2 berhasil dihapus.');
        } else {
            return redirect('checkin_regol2')->with('error', 'Data Check In Kost Regol 2 gagal dihapus.');
        }
    }
}
