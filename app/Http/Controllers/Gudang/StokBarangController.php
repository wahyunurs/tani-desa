<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StokBarang;

class StokBarangController extends Controller
{
    public function index()
    {
        // Periksa apakah pengguna memiliki role gudang
        if (Auth::user()->role !== 'gudang') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil stok barang berdasarkan gudang_id pengguna
        $stokBarang = StokBarang::where('gudang_id', Auth::user()->gudang_id)
            ->with('user')
            ->get();

        return view('stok-barang.index', [
            'title' => 'Stok Barang',
            'user' => Auth::user()->name,
            'stokBarang' => $stokBarang,
        ]);
    }

    public function filter(Request $request)
    {
        // Ambil input filter
        $jenis = $request->input('jenis');

        // Ambil stok barang berdasarkan gudang_id pengguna
        $stokBarang = StokBarang::where('gudang_id', Auth::user()->gudang_id)
            ->when($jenis, function ($query, $jenis) {
                return $query->where('jenis', $jenis);
            })
            ->with('user')
            ->get();

        return view('stok-barang.index', [
            'title' => 'Stok Barang',
            'user' => Auth::user()->name,
            'stokBarang' => $stokBarang,
        ]);
    }

    public function show($id)
    {
        // Ambil stok barang berdasarkan id
        $stokBarang = StokBarang::findOrFail($id);

        return view('stok-barang.show', [
            'title' => 'Detail Stok Barang',
            'user' => Auth::user()->name,
            'stokBarang' => $stokBarang,
        ]);
    }

    public function create()
    {
        return view('stok-barang.create', [
            'title' => 'Tambah Stok Barang',
            'user' => Auth::user()->name,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:255',
            'batas_minimal' => 'required|integer|min:1',
        ]);

        // Simpan stok barang baru
        StokBarang::create([
            'gudang_id' => Auth::user()->gudang_id,
            'nama_barang' => $request->input('nama_barang'),
            'jenis' => $request->input('jenis'),
            'jumlah' => $request->input('jumlah'),
            'satuan' => $request->input('satuan'),
            'batas_minimal' => $request->input('batas_minimal'),
        ]);

        return redirect()->route('gudang.stok-barang.index')->with('success', 'Stok barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Ambil stok barang berdasarkan id
        $stokBarang = StokBarang::findOrFail($id);

        return view('gudang.stok-barang.edit', [
            'title' => 'Edit Stok Barang',
            'user' => Auth::user()->name,
            'stokBarang' => $stokBarang,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:255',
            'batas_minimal' => 'required|integer|min:1',
        ]);

        // Temukan stok barang berdasarkan ID
        $stokBarang = StokBarang::findOrFail($id);

        // Perbarui data stok barang
        $stokBarang->update([
            'nama_barang' => $request->input('nama_barang'),
            'jenis' => $request->input('jenis'),
            'jumlah' => $request->input('jumlah'),
            'satuan' => $request->input('satuan'),
            'batas_minimal' => $request->input('batas_minimal'),
        ]);

        return redirect()->route('stok-barang.index')->with('success', 'Stok barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Temukan stok barang berdasarkan ID
        $stokBarang = StokBarang::findOrFail($id);

        // Hapus stok barang
        $stokBarang->delete();

        return redirect()->route('stok-barang.index')->with('success', 'Stok barang berhasil dihapus.');
    }
}
