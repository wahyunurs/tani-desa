<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class PenggunaAdminController extends Controller
{
    public function index(Request $request)
    {
        // Periksa apakah pengguna memiliki role admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil semua pengguna
        $users = User::whereIn('role', ['gudang', 'petani', 'distributor'])->get();

        // Ambil pengguna yang dipilih berdasarkan user_id (jika ada)
        $selectedUser = null;
        if ($request->has('user_id')) {
            $selectedUser = User::find($request->user_id);

            // Jika pengguna tidak ditemukan, kembalikan pesan error
            if (!$selectedUser) {
                return redirect()->route('admin.pengguna.index')->with('error', 'Pengguna tidak ditemukan.');
            }
        }

        return view('admin.pengguna.index', [
            'title' => 'Pengguna',
            'user' => Auth::user()->name,
            'users' => $users,
            'selectedUser' => $selectedUser ?? null,
        ]);
    }

    public function filter(Request $request)
    {
        $role = $request->input('role');

        $users = User::when($role, function ($query, $role) {
            return $query->where('role', $role);
        })->whereIn('role', ['gudang', 'petani', 'distributor'])->get();

        return view('admin.pengguna.index', [
            'title' => 'Pengguna',
            'user' => Auth::user()->name,
            'users' => $users,
        ]);
    }
}
