<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KamarCibiru1;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\table;
use function Symfony\Component\Clock\now;

class KamarCibiru1Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $kamar_cibiru1 = KamarCibiru1::with('user')->get();
        $kamar_cibiru1 = KamarCibiru1::all();
        return view('kamar_cibiru1.index', compact('kamar_cibiru1'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        $user = User::all();

        $lastKode = KamarCibiru1::latest()->first();

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode->id_kamar, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'K-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return view('kamar_cibiru1.create', compact('user', 'newKode'));
    }


    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
     $data = $request->validate([
        'id_kamar'     => 'required',
        'tipe_kamar'   => 'required',
        'no_kamar'     => 'required',
        'status_kamar' => 'required',
        'harga'        => 'required|numeric ',
        ]);

         $data['user_id'] = Auth::id();

        KamarCibiru1::create($data);

        return redirect()->route('kamar_cibiru1.index')
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
   public function edit(string $id_kamar)
    {
        $user = User::all();
        $kamar_cibiru1 = KamarCibiru1::where('id_kamar', $id_kamar)->first();
        return  view('kamar_cibiru1/edit', [
            'user' => $user,
            'kamar_cibiru1' => $kamar_cibiru1
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id_kamar)
    {

        $data = [
            'id_kamar' => $request->id_kamar,
            'tipe_kamar' => $request->tipe_kamar,
            'no_kamar' => $request->no_kamar,
            'status_kamar' => $request->status_kamar,
            'harga' => $request->harga,
            'updated_at' => now(), // Waktu diperbarui saat ini/ Nama pembuat
        ];

        DB::table('lap_kamar_cibiru1')
        ->where('id_kamar', $id_kamar)
        ->update([
            'harga' => $request->harga
        ]);

        KamarCibiru1::where('id_kamar', $id_kamar)->update($data);

        if ($data) {
            return redirect()->route('kamar_cibiru1.index')->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('kamar_cibiru1.index')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_kamar)
    {
        $kamar_cibiru1 = DB::table('kamar_cibiru1')->where('id_kamar', $id_kamar)->delete();
        if ($kamar_cibiru1) {
            return redirect('kamar_cibiru1')->withSuccess('Data Kamar Kost Cibiru 1 berhasil dihapus.');
        } else {
            return redirect('kamar_cibiru1')->with('error', 'Data Kamar Kost Cibiru 1 gagal dihapus.');
        }
    }
}
