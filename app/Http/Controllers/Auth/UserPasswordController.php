<?php

namespace App\Http\Controllers\Auth;            // alamat class (sub-folder Auth)

use App\Http\Controllers\Controller;            // controller dasar
use App\Models\User;                            // model User
use Illuminate\Http\Request;                    // pembawa data form

class UserPasswordController extends Controller  // controller kelola user & reset password (admin)
{
    public function index()                      // menampilkan daftar semua user
    {
        $users = User::orderBy('name')->get();   // ambil user, urut berdasarkan nama

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)             // form reset password untuk 1 user (dicari dari id URL)
    {
        return view('admin.users.reset-password', compact('user'));
    }

    public function update(Request $request, User $user) // menyimpan password baru
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'], // wajib, cocok dgn konfirmasi, min 8 karakter
        ]);

        $user->update([
            'password' => $request->password,    // password otomatis di-hash karena cast 'hashed' di model User
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Password user berhasil direset.');
    }

    public function destroy(User $user)          // menghapus user
    {
        if (auth()->id() === $user->id) {        // cegah admin menghapus akunnya sendiri
            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Kamu tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
