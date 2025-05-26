<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DistribusiBarang;
use App\Models\PermintaanBarang;
use App\Models\StokBarang;
use App\Models\User;

class DistribusiBarangGudangController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'gudang') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil semua stok_barang_id milik gudang yang login
        $stokIds = StokBarang::where('gudang_id', Auth::id())->pluck('id');

        // Ambil permintaan_barang berdasarkan stok_barang_id
        $permintaanBarang = PermintaanBarang::whereIn('stok_barang_id', $stokIds)->get();

        // Ambil ID permintaan
        $permintaanIds = $permintaanBarang->pluck('id');

        // Ambil distribusi_barang berdasarkan permintaan_id
        $distribusiBarang = DistribusiBarang::whereIn('permintaan_id', $permintaanIds)->get();

        // Ambil semua status unik untuk filter (opsional)
        $statusList = DistribusiBarang::select('status')->distinct()->get();

        // Ambil distribusi barang yang dipilih berdasarkan id (jika ada)
        $selectedDistribusiBarang = null;
        if (request()->has('id')) {
            $selectedDistribusiBarang = DistribusiBarang::with('permintaanBarang', 'distributor')->find(request()->id);

            // Jika distribusi barang tidak ditemukan, kembalikan pesan error
            if (!$selectedDistribusiBarang) {
                return redirect()->route('admin.distribusi-barang.index')->with('error', 'Distribusi barang tidak ditemukan.');
            }
        }

        return view('gudang.distribusi-barang.index', [
            'title' => 'Distribusi Barang',
            'permintaanBarang' => $permintaanBarang,
            'distribusiBarang' => $distribusiBarang,
            'user' => Auth::user()->name,
            'statusList' => $statusList,
            'selectedDistribusiBarang' => $selectedDistribusiBarang ?? null,
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

        return view('gudang.distribusi-barang.index', [
            'title' => 'Distribusi Barang',
            'user' => Auth::user()->name,
            'distribusiBarang' => $distribusiBarang,
            'statusList' => $statusList,
        ]);
    }

    public function create()
    {
        // List permintaan_id dari permintaan
        $permintaanList = PermintaanBarang::where('status', 'Masuk')->get();

        // Ambil semua distributor
        $distributorList = User::where('role', 'distributor')->get();

        // Tampilkan form untuk membuat distribusi barang baru
        return view('gudang.distribusi-barang.create', [
            'title' => 'Buat Distribusi Barang',
            'user' => Auth::user()->name,
            'permintaanList' => $permintaanList,
            'distributorList' => $distributorList,
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

        // Update status permintaan barang sesuai status distribusi
        $permintaan = PermintaanBarang::findOrFail($validatedData['permintaan_id']);

        if ($validatedData['status'] === 'Proses Pengiriman') {
            $permintaan->status = 'Diproses';
        } elseif ($validatedData['status'] === 'Selesai') {
            $permintaan->status = 'Selesai';
        } elseif ($validatedData['status'] === 'Gagal') {
            $permintaan->status = 'Gagal';
        }

        $permintaan->save();

        return redirect()->route('gudang.distribusi-barang.index')
            ->with('success', 'Distribusi barang berhasil dibuat dan status permintaan diperbarui.');
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'status' => 'required|in:Proses Pengiriman,Selesai,Gagal',
        ]);

        // Update status distribusi barang di database
        DistribusiBarang::where('id', $id)->update($validatedData);

        return redirect()->route('gudang.distribusi-barang.index')->with('success', 'Status distribusi barang berhasil diperbarui.');
    }

    public function edit($id)
    {
        // Periksa apakah pengguna memiliki role gudang
        if (Auth::user()->role !== 'gudang') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil semua distributor
        $distributorList = User::where('role', 'distributor')->get();

        // Ambil distribusi barang berdasarkan ID
        $distribusiBarang = DistribusiBarang::findOrFail($id);

        return view('gudang.distribusi-barang.edit', [
            'title' => 'Edit Distribusi Barang',
            'user' => Auth::user()->name,
            'distribusiBarang' => $distribusiBarang,
            'distributorList' => $distributorList,
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

        // Update status permintaan barang sesuai status distribusi
        $permintaan = PermintaanBarang::findOrFail($validatedData['permintaan_id']);

        if ($validatedData['status'] === 'Proses Pengiriman') {
            $permintaan->status = 'Diproses';
        } elseif ($validatedData['status'] === 'Selesai') {
            $permintaan->status = 'Selesai';
        } elseif ($validatedData['status'] === 'Gagal') {
            $permintaan->status = 'Gagal';
        }

        $permintaan->save();

        return redirect()->route('gudang.distribusi-barang.index')
            ->with('success', 'Distribusi barang berhasil diperbarui dan status permintaan diperbarui.');
    }

    public function destroy($id)
    {
        // Hapus distribusi barang berdasarkan ID
        $distribusiBarang = DistribusiBarang::findOrFail($id);
        $distribusiBarang->delete();

        // Perbarui status permintaan barang terkait
        $permintaan = PermintaanBarang::where('id', $distribusiBarang->permintaan_id)->first();
        if ($permintaan) {
            $permintaan->status = 'Masuk';
            $permintaan->save();
        }

        return redirect()->route('gudang.distribusi-barang.index')->with('success', 'Distribusi barang berhasil dihapus.');
    }
}
