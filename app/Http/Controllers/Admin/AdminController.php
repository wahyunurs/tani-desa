<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\StokBarang;
use App\Models\DistribusiBarang;
use App\Models\PermintaanBarang;

class AdminController extends Controller
{
    public function index()
    {
        // Periksa apakah pengguna memiliki role admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Total user berdasarkan role
        $gudangCount = User::where('role', 'gudang')->count();
        $petaniCount = User::where('role', 'petani')->count();
        $distributorCount = User::where('role', 'distributor')->count();

        // Total barang berdasarkan jenis
        $pupukCount = StokBarang::where('jenis', 'pupuk')->sum('jumlah');
        $bibitCount = StokBarang::where('jenis', 'bibit')->sum('jumlah');
        $obatCount = StokBarang::where('jenis', 'obat')->sum('jumlah');

        // 5 data permintaan barang terbaru
        $permintaanBarang = PermintaanBarang::with('user')
            ->where('status', 'Masuk')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 5 data distribusi barang terbaru
        $distribusiBarang = DistribusiBarang::with(['permintaanBarang', 'distributor'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Periksa stok barang yang menipis
        $stokMenipis = StokBarang::where('jumlah', '<=', 10)->get();

        if ($stokMenipis->isNotEmpty()) {
            session()->flash('warning', 'Ada stok barang yang hampir habis.');
        }

        // Total stok barang
        $totalStokBarang = StokBarang::sum('jumlah');

        return view('admin.index', [
            'title' => 'Dashboard Admin',
            'user' => Auth::user()->name,
            'gudangCount' => $gudangCount ?? 0,
            'petaniCount' => $petaniCount ?? 0,
            'distributorCount' => $distributorCount ?? 0,
            'totalStokBarang' => $totalStokBarang ?? 0,
            'pupukCount' => $pupukCount ?? 0,
            'bibitCount' => $bibitCount ?? 0,
            'obatCount' => $obatCount ?? 0,
            'permintaanBarang' => $permintaanBarang,
            'distribusiBarang' => $distribusiBarang,
        ]);
    }
}
