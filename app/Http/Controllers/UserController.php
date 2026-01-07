<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);
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
    public function edit(string $id)
    {
        //
        $users = User::where('id', $id)->first();
        return view('user.edit', ['users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable|regex:/^([1-9]\d*)$/',
            'picture' => 'nullable|file', // Tidak wajib saat update
        ]);

        $user = User::where('id', $id)->first();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'picture' => $request->picture
        ];

        if ($request->hasFile('picture')) {
            $newPicture = $request->file('picture')->getClientOriginalName();

            // Hapus gambar lama jika ada
            if ($user->picture && file_exists(public_path('lte/src/assets/img/' . $user->picture))) {
                unlink(public_path('lte/src/assets/img/' . $user->picture));
            }

            $data['picture'] = $newPicture;

            // Pindahkan file ke direktori yang ditentukan
            if ($request->file('picture')->isValid()) {
                $request->file('picture')->move(public_path('lte/src/assets/img'), $newPicture);
            } else {
                return redirect()->route('user.index')->with('error', 'Gagal mengunggah gambar.');
            }
        } else {
            $data['picture'] = $user->picture; // Gunakan gambar lama
        }

        // Update data pengguna
        $updateStatus = User::where('id', $id)->update($data);

        if ($updateStatus) {
            return redirect()->route('user.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('user.index')->with('error', 'Data gagal diubah');
        }
    }


    /**
     * Detail User
     */

    public function detail(string $id)
    {
        $users = User::where('id', $id)->first();
        return view('user.detail', ['users' => $users]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->delete();
            return redirect('user')->withSuccess('Data user berhasil dihapus..');
        } else {
            return redirect('user')->with('error', 'Data user gagal dihapus..');
        }
    }

     public function logout(Request $request)
{
    Auth::logout();
    
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    $request->session()->flush(); // tambahkan ini
    
    return redirect()->route('login')->with('success', 'Logout berhasil');
}
}
