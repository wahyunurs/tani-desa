<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\StokBarang;
use App\Models\Laporan;
use App\Models\User;

class StokBarangGudangController extends Controller
{
    public function index()
    {
        // Periksa apakah pengguna memiliki role gudang
        if (Auth::user()->role !== 'gudang') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil stok barang berdasarkan gudang_id pengguna
        $stokBarang = StokBarang::where('gudang_id', Auth::user()->id)
            ->with('user')
            ->get();

        return view('gudang.stok-barang.index', [
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
        $stokBarang = StokBarang::where('gudang_id', Auth::user()->id)
            ->when($jenis, function ($query, $jenis) {
                return $query->where('jenis', $jenis);
            })
            ->with('user')
            ->get();

        return view('gudang.stok-barang.index', [
            'title' => 'Stok Barang',
            'user' => Auth::user()->name,
            'stokBarang' => $stokBarang,
        ]);
    }

    public function show($id)
    {
        // Ambil stok barang berdasarkan id
        $stokBarang = StokBarang::findOrFail($id);

        return view('gudang.stok-barang.show', [
            'title' => 'Detail Stok Barang',
            'user' => Auth::user()->name,
            'stokBarang' => $stokBarang,
        ]);
    }

    public function create()
    {

        return view('gudang.stok-barang.create', [
            'title' => 'Tambah Stok Barang',
            'user' => Auth::user()->name,
        ]);
    }

    public function store(Request $request)
    {
        $gudang_id = Auth::user()->id;

        // Validasi input
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_barang' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:255',
        ]);

        // Jika ada foto yang diunggah, simpan foto tersebut
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = date('Y-m-d-') . $foto->getClientOriginalName();
            $path = 'foto-barang/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($foto));
        }

        // Buat stok barang baru
        $stokBarang = StokBarang::create([
            'gudang_id' => $gudang_id,
            'foto' => $filename ?? null,
            'nama_barang' => $request->input('nama_barang'),
            'jenis' => $request->input('jenis'),
            'jumlah' => $request->input('jumlah'),
            'satuan' => $request->input('satuan'),
        ]);

        // Tambahkan data ke model Laporan dengan status "masuk"
        Laporan::create([
            'barang_id' => $stokBarang->id,
            'nama_barang' => $stokBarang->nama_barang,
            'jumlah' => $stokBarang->jumlah,
            'status' => 'masuk',
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
        $gudang_id = Auth::user()->id;

        // Validasi input
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_barang' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:255',
            'status' => 'required|in:masuk,keluar',
        ]);

        // Temukan stok barang berdasarkan ID
        $stokBarang = StokBarang::findOrFail($id);

        // Hitung jumlah baru berdasarkan tipe
        $jumlahBaru = $stokBarang->jumlah;
        if ($request->input('status') === 'masuk') {
            $jumlahBaru += $request->input('jumlah');
        } elseif ($request->input('status') === 'keluar') {
            // Periksa apakah jumlah baru tidak boleh di bawah batas minimal
            if ($stokBarang->jumlah - $request->input('jumlah') < $stokBarang->batas_minimal) {
                return redirect()->back()->with('error', 'Jumlah stok tidak boleh di bawah batas minimal.');
            }
            $jumlahBaru -= $request->input('jumlah');
        }

        $newFoto = $stokBarang->foto;

        // If the foto is updated
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = date('Y-m-d-') . $foto->getClientOriginalName();
            $path       = 'foto-barang/' . $filename;

            // Store the new foto
            Storage::disk('public')->put($path, file_get_contents($foto));

            // Delete the foto from storage
            if ($stokBarang->foto) {
                Storage::disk('public')->delete('foto-barang/' . $stokBarang->foto);
            }

            $newFoto = $filename;
        }

        // Update stok barang
        $stokBarang->update([
            'gudang_id' => $gudang_id,
            'foto' => $newFoto,
            'nama_barang' => $request->input('nama_barang'),
            'jenis' => $request->input('jenis'),
            'jumlah' => $jumlahBaru,
            'satuan' => $request->input('satuan'),
            'batas_minimal' => $request->input('batas_minimal'),
        ]);

        // Tambahkan data ke model Laporan berdasarkan status
        Laporan::create([
            'barang_id' => $stokBarang->id,
            'nama_barang' => $stokBarang->nama_barang,
            'jumlah' => $request->input('jumlah'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('gudang.stok-barang.index')->with('success', 'Stok barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Temukan stok barang berdasarkan ID
        $stokBarang = StokBarang::findOrFail($id);

        // Hapus foto dari storage
        if ($stokBarang->foto) {
            Storage::delete('public/foto-barang/' . $stokBarang->foto);
        }

        // Hapus stok barang
        $stokBarang->delete();

        return redirect()->route('gudang.stok-barang.index')->with('success', 'Stok barang berhasil dihapus.');
    }
}
