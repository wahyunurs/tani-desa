<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\StokBarang;
use Illuminate\Http\Request;
use App\Models\PermintaanBarang;
use Illuminate\Support\Facades\Auth;

class BarangPetaniController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role !== 'petani') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $user = Auth::user();

        // Ambil query filter dan search dari request
        $filter = $request->input('filter'); // Jenis barang (pupuk, bibit, obat, dll.)
        $search = $request->input('search'); // Kata kunci pencarian

        // Query stok barang berdasarkan desa user
        $stokBarangQuery = StokBarang::whereHas('user', function ($query) use ($user) {
            $query->where('desa', $user->desa);
        });

        // Filter berdasarkan jenis barang
        if ($filter && $filter !== 'all') {
            $stokBarangQuery->where('jenis', $filter);
        }

        // Pencarian berdasarkan nama barang
        if ($search) {
            $stokBarangQuery->where('nama_barang', 'like', '%' . $search . '%');
        }

        $stokBarang = $stokBarangQuery->get();

        return view('petani.barang.index', [
            'title' => 'Barang Petani',
            'stokBarang' => $stokBarang,
            'filter' => $filter,
            'search' => $search,
        ]);
    }

    public function store(Request $request)
    {
        $petani_id = Auth::user()->id;
        // Validasi input
        $request->validate([
            'stok_barang_id' => 'required|exists:stok_barangs,id',
            'nama_barang' => 'required|string|max:100',
            'jumlah' => 'required|integer|min:1',
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
            'petani_id' => $petani_id,
            'stok_barang_id' => $request->stok_barang_id,
            'nama_barang' => $stokBarang->nama_barang,
            'jumlah' => $request->jumlah,
            'status' => 'Masuk',
        ]);

        return redirect()->route('petani.barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }
}
