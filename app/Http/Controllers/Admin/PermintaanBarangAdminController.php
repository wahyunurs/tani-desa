<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermintaanBarang;
use App\Models\StokBarang;
use App\Models\User;
use App\Models\DistribusiBarang;

class PermintaanBarangAdminController extends Controller
{
    public function index()
    {
        // Periksa apakah pengguna memiliki role admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil semua permintaan barang
        $permintaanBarang = PermintaanBarang::with('user')->get();

        $statusList = PermintaanBarang::select('status')
            ->distinct()
            ->get();


        return view('admin.permintaan-barang.index', [
            'title' => 'Permintaan Barang',
            'permintaanBarang' => $permintaanBarang,
            'user' => Auth::user()->name,
            'statusList' => $statusList,
        ]);
    }

    public function filter(Request $request)
    {
        $status = $request->input('status');

        $permintaanBarang = PermintaanBarang::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->whereIn('status', ['Masuk', 'Diproses', 'Selesai'])->get();

        $statusList = PermintaanBarang::select('status')
            ->distinct()
            ->get();

        return view('admin.permintaan-barang.index', [
            'title' => 'Permintaan Barang',
            'user' => Auth::user()->name,
            'permintaanBarang' => $permintaanBarang,
            'statusList' => $statusList,
        ]);
    }

    public function show($id)
    {
        // Ambil permintaan barang berdasarkan ID
        $permintaanBarang = PermintaanBarang::findOrFail($id);

        return view('admin.permintaan-barang.show', [
            'title' => 'Detail Permintaan Barang',
            'permintaanBarang' => $permintaanBarang,
        ]);
    }

    public function distribusi($id)
    {
        // Ambil permintaan barang berdasarkan ID
        $permintaanBarang = PermintaanBarang::findOrFail($id);

        // Ambil semua distributor
        $distributorList = User::where('role', 'distributor')->get();

        return view('admin.permintaan-barang.distribusi', [
            'title' => 'Distribusi Permintaan Barang',
            'user' => Auth::user()->name,
            'permintaanBarang' => $permintaanBarang,
            'distributorList' => $distributorList,
        ]);
    }

    public function distribusiStore(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'permintaan_id' => 'required|exists:permintaan_barangs,id',
            'distributor_id' => 'required|exists:users,id',
        ]);

        // Simpan data distribusi barang ke database
        DistribusiBarang::create([
            'permintaan_id' => $validatedData['permintaan_id'],
            'distributor_id' => $validatedData['distributor_id'],
            'status' => 'Proses Pengiriman',
        ]);

        // Update status permintaan barang
        $permintaanBarang = PermintaanBarang::findOrFail($validatedData['permintaan_id']);
        $permintaanBarang->update([
            'status' => 'Diproses',
        ]);

        return redirect()->route('admin.permintaan-barang.index')->with('success', 'Permintaan barang berhasil didistribusikan.');
    }

    public function create()
    {
        $stokBarang = StokBarang::all();

        $petaniList = PermintaanBarang::select('petani_id')
            ->distinct()
            ->with('user')
            ->get();

        $barangList = StokBarang::select('id', 'nama_barang')
            ->distinct()
            ->get();

        return view('admin.permintaan-barang.create', [
            'title' => 'Buat Permintaan Barang',
            'stokBarang' => $stokBarang,
            'petaniList' => $petaniList,
            'barangList' => $barangList,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'petani_id' => 'required|exists:users,id',
            'stok_barang_id' => 'required|exists:stok_barangs,id',
            'jumlah' => 'required|numeric|min:1',
        ]);

        // Ambil stok barang berdasarkan stok_barang_id
        $stokBarang = StokBarang::findOrFail($request->stok_barang_id);

        // Periksa apakah stok mencukupi
        if ($stokBarang->jumlah < $request->jumlah) {
            return redirect()->back()->with('error', 'Jumlah permintaan melebihi stok yang tersedia.');
        }

        // Kurangi jumlah stok barang
        $stokBarang->decrement('jumlah', $request->jumlah);

        // Simpan data permintaan barang
        PermintaanBarang::create([
            'petani_id' => $request->petani_id,
            'stok_barang_id' => $request->stok_barang_id,
            'nama_barang' => $stokBarang->nama_barang,
            'jumlah' => $request->jumlah,
            'status' => 'Masuk',
        ]);

        return redirect()->route('admin.permintaan-barang.index')->with('success', 'Permintaan barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Ambil permintaan barang berdasarkan ID
        $permintaanBarang = PermintaanBarang::findOrFail($id);

        $stokBarang = StokBarang::all();

        $petaniList = PermintaanBarang::select('petani_id')
            ->distinct()
            ->with('user')
            ->get();

        $barangList = StokBarang::select('id', 'nama_barang')
            ->distinct()
            ->get();

        return view('admin.permintaan-barang.edit', [
            'title' => 'Edit Permintaan Barang',
            'permintaanBarang' => $permintaanBarang,
            'stokBarang' => $stokBarang,
            'petaniList' => $petaniList,
            'barangList' => $barangList,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'petani_id' => 'required|exists:users,id',
            'stok_barang_id' => 'required|exists:stok_barangs,id',
            'jumlah' => 'required|numeric|min:1',
        ]);

        // Temukan permintaan barang berdasarkan ID
        $permintaanBarang = PermintaanBarang::findOrFail($id);

        // Update status permintaan barang
        $permintaanBarang->update([
            'petani_id' => $request->petani_id,
            'stok_barang_id' => $request->stok_barang_id,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('admin.permintaan-barang.index')->with('success', 'Permintaan barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Temukan permintaan barang berdasarkan ID
        $permintaanBarang = PermintaanBarang::findOrFail($id);

        // Hapus permintaan barang
        $permintaanBarang->delete();

        return redirect()->route('admin.permintaan-barang.index')->with('success', 'Permintaan barang berhasil dihapus.');
    }
}
