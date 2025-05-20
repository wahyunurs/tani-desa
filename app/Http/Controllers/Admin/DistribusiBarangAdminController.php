<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DistribusiBarang;

class DistribusiBarangAdminController extends Controller
{
    public function index()
    {
        // Periksa apakah pengguna memiliki role admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil semua distribusi barang
        $distribusiBarang = DistribusiBarang::with('permintaanBarang', 'distributor')->get();

        $statusList = DistribusiBarang::select('status')
            ->distinct()
            ->get();

        // Ambil distribusi barang yang dipilih berdasarkan id (jika ada)
        $selectedDistribusiBarang = null;
        if (request()->has('id')) {
            $selectedDistribusiBarang = DistribusiBarang::with('permintaanBarang', 'distributor')->find(request()->id);

            // Jika distribusi barang tidak ditemukan, kembalikan pesan error
            if (!$selectedDistribusiBarang) {
                return redirect()->route('distribusi-barang.index')->with('error', 'Distribusi barang tidak ditemukan.');
            }
        }

        return view('admin.distribusi-barang.index', [
            'title' => 'Distribusi Barang',
            'user' => Auth::user()->name,
            'distribusiBarang' => $distribusiBarang,
            'selectedDistribusiBarang' => $selectedDistribusiBarang ?? null,
            'statusList' => $statusList,
        ]);
    }

    public function filter(Request $request)
    {
        $status = $request->input('status');

        $distribusiBarang = DistribusiBarang::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->whereIn('status', ['Proses Pengiriman', 'Selesai', 'Gagal'])->get();

        $statusList = DistribusiBarang::select('status')
            ->distinct()
            ->get();

        return view('admin.distribusi-barang.index', [
            'title' => 'Distribusi Barang',
            'user' => Auth::user()->name,
            'distribusiBarang' => $distribusiBarang,
            'statusList' => $statusList,
        ]);
    }

    public function show($id)
    {
        // Ambil distribusi barang berdasarkan ID
        $distribusiBarang = DistribusiBarang::with('distributor', 'permintaanBarang')->findOrFail($id);

        return view('admin.distribusi-barang.show', [
            'title' => 'Detail Distribusi Barang',
            'distribusiBarang' => $distribusiBarang,
            'permintaanBarang' => $distribusiBarang->permintaanBarang, // Relasi ke permintaan barang
        ]);
    }

    public function create()
    {
        // Tampilkan form untuk membuat distribusi barang baru
        return view('admin.distribusi-barang.create', [
            'title' => 'Buat Distribusi Barang',
            'user' => Auth::user()->name,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'permintaan_id' => 'required|exists:permintaan_barangs,id',
            'distributor_id' => 'required|exists:users,id',
            'status' => 'required|in:Proses Pengiriman,Selesai,Gagal',
        ]);

        // Simpan data distribusi barang ke database
        DistribusiBarang::create($validatedData);

        return redirect()->route('distribusi-barang.index')->with('success', 'Distribusi barang berhasil dibuat.');
    }

    public function edit($id)
    {
        // Ambil distribusi barang berdasarkan ID
        $distribusiBarang = DistribusiBarang::findOrFail($id);

        return view('admin.distribusi-barang.edit', [
            'title' => 'Edit Distribusi Barang',
            'user' => Auth::user()->name,
            'distribusiBarang' => $distribusiBarang,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'permintaan_id' => 'required|exists:permintaan_barangs,id',
            'distributor_id' => 'required|exists:users,id',
            'status' => 'required|in:Proses Pengiriman,Selesai,Gagal',
        ]);

        // Update data distribusi barang di database
        DistribusiBarang::where('id', $id)->update($validatedData);

        return redirect()->route('distribusi-barang.index')->with('success', 'Distribusi barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Hapus distribusi barang berdasarkan ID
        $distribusiBarang = DistribusiBarang::findOrFail($id);
        $distribusiBarang->delete();

        return redirect()->route('distribusi-barang.index')->with('success', 'Distribusi barang berhasil dihapus.');
    }
}
