<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DistribusiBarang;
use App\Models\PermintaanBarang;
use App\Models\StokBarang;
use App\Models\User;

class DistribusiBarangDistributorController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'distributor') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil distribusi_barang berdasarkan distributor_id
        $distribusiBarang = DistribusiBarang::where('distributor_id', Auth::user()->id)
            ->with(['permintaanBarang.user', 'permintaanBarang.stokBarang'])
            ->get();

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

        return view('distributor.distribusi-barang.index', [
            'title' => 'Distribusi Barang',
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
        })->whereIn('status', ['Proses Pengiriman', 'Selesai', 'Gagal'])
            ->with(['permintaanBarang.user', 'permintaanBarang.stokBarang'])
            ->get();

        $statusList = DistribusiBarang::select('status')
            ->distinct()
            ->get();

        return view('distributor.distribusi-barang.index', [
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

        // Tampilkan form untuk membuat distribusi barang baru
        return view('distributor.distribusi-barang.create', [
            'title' => 'Tambah Distribusi Barang',
            'user' => Auth::user()->name,
            'permintaanList' => $permintaanList,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'permintaan_id' => 'required|exists:permintaan_barangs,id',
        ]);

        // Set status distribusi barang
        $validatedData['status'] = 'Proses Pengiriman';

        // Tambah data distribusi barang ke database
        DistribusiBarang::create([
            'permintaan_id' => $validatedData['permintaan_id'],
            'distributor_id' => Auth::user()->id,
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('distributor.distribusi-barang.index')
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

        return redirect()->route('distributor.distribusi-barang.index')->with('success', 'Status distribusi barang berhasil diperbarui.');
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

        return redirect()->route('distributor.distribusi-barang.index')->with('success', 'Distribusi barang berhasil dihapus.');
    }
}
