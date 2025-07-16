<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\StokBarang;
use App\Models\Laporan;

class StokBarangAdminController extends Controller
{
    public function index()
    {
        // Periksa apakah pengguna memiliki role admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $gudangList = StokBarang::select('gudang_id')
            ->distinct()
            ->with('user')
            ->get();

        // Ambil semua stok barang
        $stokBarang = StokBarang::with('user')->get();

        return view('admin.stok-barang.index', [
            'title' => 'Stok Barang',
            'user' => Auth::user()->name,
            'stokBarang' => $stokBarang,
            'gudangList' => $gudangList,
        ]);
    }

    public function filter(Request $request)
    {
        // Ambil input filter
        $jenis = $request->input('jenis');
        $gudang = $request->input('gudang_id');

        $gudangList = StokBarang::select('gudang_id')
            ->distinct()
            ->with('user')
            ->get();

        // Filter stok barang berdasarkan jenis dan gudang_id
        $stokBarang = StokBarang::when($jenis, function ($query, $jenis) {
            return $query->where('jenis', $jenis);
        })->when($gudang, function ($query, $gudang) {
            return $query->where('gudang_id', $gudang);
        })->with('user')->get();

        return view('admin.stok-barang.index', [
            'title' => 'Stok Barang',
            'user' => Auth::user()->name,
            'gudangList' => $gudangList,
            'stokBarang' => $stokBarang,
        ]);
    }

    public function create()
    {
        $gudangList = StokBarang::select('gudang_id')
            ->distinct()
            ->with('user')
            ->get();

        // Tampilkan form untuk menambahkan stok barang baru
        return view('admin.stok-barang.create', [
            'title' => 'Tambah Stok Barang',
            'user' => Auth::user()->name,
            'gudangList' => $gudangList,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'gudang_id' => 'required|exists:users,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'nama_barang' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:255',
        ]);

        // Jika ada file foto, cek ukuran manual (dalam MB)
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $maxMb = 5;
            if ($foto->getSize() > ($maxMb * 1024 * 1024)) {
                return redirect()->back()->withErrors(['foto' => 'Ukuran foto tidak boleh lebih dari ' . $maxMb . ' MB.'])->withInput();
            }
        }

        // Jika ada foto yang diunggah, simpan foto tersebut
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = date('Y-m-d-') . $foto->getClientOriginalName();
            $path = 'foto-barang/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($foto));
        }

        // Buat stok barang baru
        $stokBarang = StokBarang::create([
            'gudang_id' => $request->input('gudang_id'),
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

        return redirect()->route('admin.stok-barang.index')->with('success', 'Stok barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $gudangList = StokBarang::select('gudang_id')
            ->distinct()
            ->with('user')
            ->get();

        // Temukan stok barang berdasarkan ID
        $stokBarang = StokBarang::findOrFail($id);

        return view('admin.stok-barang.edit', [
            'title' => 'Edit Stok Barang',
            'user' => Auth::user()->name,
            'stokBarang' => $stokBarang,
            'gudangList' => $gudangList,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'gudang_id' => 'required|exists:users,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'nama_barang' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'tambah_stok' => 'nullable|integer|min:0',
            'kurang_stok' => 'nullable|integer|min:0',
        ]);

        // Jika ada file foto, cek ukuran manual (dalam MB)
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $maxMb = 5;
            if ($foto->getSize() > ($maxMb * 1024 * 1024)) {
                return redirect()->back()->withErrors(['foto' => 'Ukuran foto tidak boleh lebih dari ' . $maxMb . ' MB.'])->withInput();
            }
        }

        // Temukan stok barang berdasarkan ID
        $stokBarang = StokBarang::findOrFail($id);

        // Hitung jumlah baru berdasarkan field tambah_stok atau kurang_stok
        $jumlahBaru = $stokBarang->jumlah;
        $status = null;
        $jumlahPerubahan = 0;

        if ($request->input('tambah_stok') && $request->input('tambah_stok') > 0) {
            $jumlahPerubahan = $request->input('tambah_stok');
            $jumlahBaru += $jumlahPerubahan;
            $status = 'masuk';
        } elseif ($request->input('kurang_stok') && $request->input('kurang_stok') > 0) {
            $jumlahPerubahan = $request->input('kurang_stok');
            $jumlahBaru -= $jumlahPerubahan;
            $status = 'keluar';

            // Pastikan stok tidak negatif
            if ($jumlahBaru < 0) {
                return redirect()->back()->withErrors(['kurang_stok' => 'Stok tidak mencukupi. Stok saat ini: ' . $stokBarang->jumlah])->withInput();
            }
        }

        $newFoto = $stokBarang->foto;

        // If the foto is updated
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = date('Y-m-d-') . $foto->getClientOriginalName();
            $path = 'foto-barang/' . $filename;

            // Store the new foto
            Storage::disk('public')->put($path, file_get_contents($foto));

            // Delete the old foto from storage
            if ($stokBarang->foto) {
                Storage::disk('public')->delete('foto-barang/' . $stokBarang->foto);
            }

            $newFoto = $filename;
        }

        // Update stok barang
        $stokBarang->update([
            'gudang_id' => $request->input('gudang_id'),
            'foto' => $newFoto,
            'nama_barang' => $request->input('nama_barang'),
            'jenis' => $request->input('jenis'),
            'jumlah' => $jumlahBaru,
            'satuan' => $request->input('satuan'),
        ]);

        // Tambahkan data ke model Laporan jika ada perubahan stok
        if ($status && $jumlahPerubahan > 0) {
            Laporan::create([
                'barang_id' => $stokBarang->id,
                'nama_barang' => $stokBarang->nama_barang,
                'jumlah' => $jumlahPerubahan,
                'status' => $status,
            ]);
        }

        return redirect()->route('admin.stok-barang.index')->with('success', 'Stok barang berhasil diperbarui.');
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

        return redirect()->route('admin.stok-barang.index')->with('success', 'Stok barang berhasil dihapus.');
    }
}
