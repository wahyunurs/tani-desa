<?php

namespace App\Http\Controllers\Gudang;

use App\Models\StokBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DistribusiBarang;
use App\Models\PermintaanBarang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GudangController extends Controller
{
    public function index()
    {
        // Periksa apakah pengguna memiliki role gudang
        if (Auth::user()->role !== 'gudang') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Total barang berdasarkan jenis
        $pupukCount = StokBarang::where('jenis', 'pupuk')
            ->where('gudang_id', Auth::user()->id)
            ->sum('jumlah');

        $bibitCount = StokBarang::where('jenis', 'bibit')
            ->where('gudang_id', Auth::user()->id)
            ->sum('jumlah');

        $obatCount = StokBarang::where('jenis', 'obat')
            ->where('gudang_id', Auth::user()->id)
            ->sum('jumlah');

        // Ambil semua stok_barang_id milik gudang yang login
        $stokIds = StokBarang::where('gudang_id', Auth::id())->pluck('id');

        // 5 data permintaan barang terbaru
        $permintaanBarang = PermintaanBarang::with('user')
            ->whereIn('stok_barang_id', $stokIds)
            ->where('status', 'Masuk')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Ambil ID permintaan
        $permintaanIds = $permintaanBarang->pluck('id');

        // 5 data distribusi barang terbaru
        $distribusiBarang = DistribusiBarang::with(['permintaanBarang', 'distributor'])
            ->whereIn('permintaan_id', $permintaanIds)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Periksa stok barang yang menipis
        $stokMenipis = StokBarang::where('jumlah', '<=', 10)->get();

        if ($stokMenipis->isNotEmpty()) {
            session()->flash('warning', 'Ada stok barang yang hampir habis.');
        }

        // Data untuk diagram garis (total permintaan setiap bulan dalam 5 bulan terakhir)
        $totalPermintaanPerBulan = collect([]);
        for ($i = 4; $i >= 0; $i--) { // Loop mundur untuk urutan dari terlama ke terbaru
            $bulan = now()->subMonths($i)->month;
            $tahun = now()->subMonths($i)->year;

            $totalPermintaan = PermintaanBarang::whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun)
                ->count();

            $totalPermintaanPerBulan->push([
                'bulan' => $bulan,
                'tahun' => $tahun,
                'total' => $totalPermintaan,
            ]);
        }

        // Format data untuk diagram garis
        $diagramData = [
            'labels' => $totalPermintaanPerBulan->map(function ($item) {
                return Carbon::create($item['tahun'], $item['bulan'])->translatedFormat('F Y');
            }),
            'data' => $totalPermintaanPerBulan->pluck('total'),
        ];

        return view('gudang.index', [
            'title' => 'Dashboard Gudang',
            'user' => Auth::user()->name,
            'pupukCount' => $pupukCount ?? 0,
            'bibitCount' => $bibitCount ?? 0,
            'obatCount' => $obatCount ?? 0,
            'totalStokBarang' => $totalStokBarang ?? 0,
            'permintaanBarang' => $permintaanBarang,
            'distribusiBarang' => $distribusiBarang,
            'diagramData' => $diagramData,
        ]);
    }
}
