<?php

namespace App\Http\Controllers\Petani;

use Illuminate\Http\Request;
use App\Models\PermintaanBarang;
use App\Models\Laporan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class PermintaanBarangPetaniController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role !== 'petani') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil query filter dan search dari request
        $filterStatus = $request->input('filter_status'); // Filter berdasarkan status
        $filterJenis = $request->input('filter_jenis'); // Filter berdasarkan jenis
        $search = $request->input('search'); // Kata kunci pencarian

        // Query permintaan barang berdasarkan petani yang login
        $permintaanBarangsQuery = PermintaanBarang::where('petani_id', Auth::user()->id);

        // Filter berdasarkan status
        if ($filterStatus && $filterStatus !== 'all') {
            $permintaanBarangsQuery->where('status', $filterStatus);
        }

        // Filter berdasarkan jenis
        if ($filterJenis && $filterJenis !== 'all') {
            $permintaanBarangsQuery->whereHas('stokBarang', function ($query) use ($filterJenis) {
                $query->where('jenis', $filterJenis);
            });
        }

        // Pencarian berdasarkan nama barang
        if ($search) {
            $permintaanBarangsQuery->where('nama_barang', 'like', '%' . $search . '%');
        }

        $permintaanBarangs = $permintaanBarangsQuery->get();

        return view('petani.permintaan.index', [
            'title' => 'Permintaan Barang Petani',
            'permintaanBarangs' => $permintaanBarangs,
            'filterStatus' => $filterStatus,
            'filterJenis' => $filterJenis,
            'search' => $search,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input jumlah
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        // Cari permintaan barang berdasarkan ID
        $permintaanBarang = PermintaanBarang::findOrFail($id);

        // Cek apakah permintaan masih bisa diupdate (status masuk atau diproses)
        if (!in_array(strtolower($permintaanBarang->status), ['masuk', 'diproses'])) {
            return redirect()->back()->with('error', 'Permintaan dengan status "' . $permintaanBarang->status . '" tidak dapat diubah.');
        }

        // Cari stok barang terkait
        $stokBarang = $permintaanBarang->stokBarang;

        // Hitung perubahan jumlah
        $jumlahSebelumnya = $permintaanBarang->jumlah;
        $jumlahBaru = $request->jumlah;
        $selisihJumlah = $jumlahBaru - $jumlahSebelumnya;

        // Jika tidak ada perubahan jumlah, tidak perlu update
        if ($selisihJumlah == 0) {
            return redirect()->route('petani.permintaan.index')->with('info', 'Tidak ada perubahan jumlah.');
        }

        if ($jumlahBaru > $jumlahSebelumnya) {
            // Jika jumlah baru lebih besar, cek apakah stok mencukupi
            $tambahJumlah = $jumlahBaru - $jumlahSebelumnya;
            if ($stokBarang->jumlah < $tambahJumlah) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $stokBarang->jumlah);
            }

            // Kurangi stok barang
            $stokBarang->update([
                'jumlah' => $stokBarang->jumlah - $tambahJumlah,
            ]);

            // Tambahkan laporan keluar untuk penambahan jumlah
            Laporan::create([
                'barang_id' => $stokBarang->id,
                'nama_barang' => $stokBarang->nama_barang,
                'jumlah' => $tambahJumlah,
                'status' => 'keluar',
            ]);
        } elseif ($jumlahBaru < $jumlahSebelumnya) {
            // Jika jumlah baru lebih kecil, tambahkan kembali stok barang
            $kurangJumlah = $jumlahSebelumnya - $jumlahBaru;
            $stokBarang->update([
                'jumlah' => $stokBarang->jumlah + $kurangJumlah,
            ]);

            // Tambahkan laporan masuk untuk pengurangan jumlah (return barang)
            Laporan::create([
                'barang_id' => $stokBarang->id,
                'nama_barang' => $stokBarang->nama_barang,
                'jumlah' => $kurangJumlah,
                'status' => 'masuk',
            ]);
        }

        // Update jumlah permintaan
        $permintaanBarang->update([
            'jumlah' => $jumlahBaru,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('petani.permintaan.index')->with('success', 'Jumlah permintaan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Menghapus permintaan barang
        $permintaanBarang = PermintaanBarang::findOrFail($id);

        // Cek apakah permintaan masih bisa dihapus (status masuk atau diproses)
        if (!in_array(strtolower($permintaanBarang->status), ['masuk', 'diproses'])) {
            return redirect()->back()->with('error', 'Permintaan dengan status "' . $permintaanBarang->status . '" tidak dapat dihapus.');
        }

        // Kembalikan stok barang ke gudang
        $stokBarang = $permintaanBarang->stokBarang;
        if ($stokBarang) {
            $stokBarang->update([
                'jumlah' => $stokBarang->jumlah + $permintaanBarang->jumlah,
            ]);

            // Tambahkan laporan masuk untuk barang yang dikembalikan
            Laporan::create([
                'barang_id' => $stokBarang->id,
                'nama_barang' => $stokBarang->nama_barang,
                'jumlah' => $permintaanBarang->jumlah,
                'status' => 'masuk',
            ]);
        }

        // Hapus permintaan barang
        $permintaanBarang->delete();

        return redirect()->route('petani.permintaan.index')->with('success', 'Permintaan barang berhasil dihapus dan stok dikembalikan.');
    }
}
