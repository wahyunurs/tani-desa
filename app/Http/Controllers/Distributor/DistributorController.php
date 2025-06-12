<?php

namespace App\Http\Controllers\Distributor;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DistribusiBarang;
use App\Models\PermintaanBarang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DistributorController extends Controller
{
    public function index()
    {
        // Periksa apakah pengguna memiliki role gudang
        if (Auth::user()->role !== 'distributor') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil semua permintaan_id dari distribusi_barang milik distributor yang sedang login
        $permintaanIds = DistribusiBarang::where('distributor_id', Auth::id())
            ->pluck('permintaan_id');

        // 5 data permintaan barang terbaru
        $permintaanBarang = PermintaanBarang::whereIn('id', $permintaanIds)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 5 data distribusi barang terbaru
        $distribusiBarang = DistribusiBarang::with(['permintaanBarang'])
            ->where('distributor_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Data untuk diagram garis (total distribusi setiap bulan selama 5 bulan terakhir)
        $totalDistribusiPerBulan = collect([]);
        for ($i = 4; $i >= 0; $i--) {
            $bulan = now()->subMonths($i)->month;
            $tahun = now()->subMonths($i)->year;

            // Hitung total distribusi berdasarkan distributor_id yang sedang login
            $totalDistribusi = DistribusiBarang::where('distributor_id', Auth::user()->id)
                ->whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun)
                ->count();

            $totalDistribusiPerBulan->push([
                'bulan' => $bulan,
                'tahun' => $tahun,
                'total' => $totalDistribusi,
            ]);
        }

        // Format data untuk diagram garis
        $diagramData = [
            'labels' => $totalDistribusiPerBulan->map(function ($item) {
                return Carbon::create($item['tahun'], $item['bulan'])->translatedFormat('F Y');
            }),
            'data' => $totalDistribusiPerBulan->pluck('total'),
        ];

        return view('distributor.index', [
            'title' => 'Dashboard Distributor',
            'user' => Auth::user()->name,
            'permintaanBarang' => $permintaanBarang,
            'distribusiBarang' => $distribusiBarang,
            'diagramData' => $diagramData,
        ]);
    }
}
