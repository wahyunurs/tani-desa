<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;


class PenggunaAdminController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->input('role');

        // Periksa apakah pengguna memiliki role admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil semua pengguna
        $query = User::whereIn('role', ['gudang', 'petani', 'distributor']);

        // Jika ada filter role, terapkan filter
        if ($role) {
            $query->where('role', 'LIKE', '%' . $role . '%');
        }

        $users = $query->get();

        return view('admin.pengguna.index', [
            'title' => 'Pengguna',
            'user' => Auth::user()->name,
            'users' => $users,
        ]);
    }

    public function filter(Request $request)
    {
        $role = $request->input('role');

        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil semua pengguna
        $query = User::whereIn('role', ['gudang', 'petani', 'distributor']);

        // Jika ada filter role, terapkan filter
        if ($role) {
            $query->where('role', 'LIKE', '%' . $role . '%');
        }

        $users = $query->get();

        return view('admin.pengguna.index', [
            'title' => 'Pengguna',
            'user' => Auth::user()->name,
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        // Periksa apakah pengguna memiliki role admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil semua pengguna untuk ditampilkan di tabel
        $users = User::whereIn('role', ['gudang', 'petani', 'distributor'])->get();

        // Ambil data user yang dipilih untuk modal
        $selectedUser = User::findOrFail($id);

        return view('admin.pengguna.index', [
            'title' => 'Pengguna',
            'user' => Auth::user()->name,
            'users' => $users,
            'selectedUser' => $selectedUser,
        ]);
    }

    public function create()
    {
        // Periksa apakah pengguna memiliki role admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('admin.pengguna.create', [
            'title' => 'Tambah Pengguna',
            'user' => Auth::user()->name,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'alamat' => ['required', 'string', 'max:255'],
            'desa' => ['required', 'string', 'max:255'],
            'nomor_telepon' => ['required', 'string', 'max:15', 'regex:/^[0-9]+$/'],
        ]);

        // Buat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('pasword'),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Periksa apakah pengguna memiliki role admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $user = User::findOrFail($id);

        return view('admin.pengguna.edit', [
            'title' => 'Edit Pengguna',
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'alamat' => ['required', 'string', 'max:255'],
            'desa' => ['required', 'string', 'max:255'],
            'nomor_telepon' => ['required', 'string', 'max:15', 'regex:/^[0-9]+$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Temukan pengguna yang akan diupdate
        $user = User::findOrFail($id);

        // Update data pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Simpan perubahan
        $user->save();

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Periksa apakah pengguna memiliki role admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Temukan pengguna yang akan dihapus
        $user = User::findOrFail($id);

        // Hapus pengguna
        $user->delete();

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
