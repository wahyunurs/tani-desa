<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PermintaanBarang;
use App\Models\StokBarang;
use App\Models\User;
use App\Models\DistribusiBarang;

class PermintaanBarangDistributorController extends Controller
{
    public function index()
    {
        // Pastikan yang login adalah distributor
        if (Auth::user()->role !== 'distributor') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil semua permintaan_id dari distribusi_barang milik distributor yang sedang login
        $permintaanIds = DB::table('distribusi_barangs')
            ->where('distributor_id', Auth::id())
            ->pluck('permintaan_id');

        // Ambil semua permintaan barang berdasarkan ID tersebut
        $permintaanBarang = PermintaanBarang::whereIn('id', $permintaanIds)->get();

        // Ambil status unik dari permintaan-permintaan ini
        $statusList = PermintaanBarang::whereIn('id', $permintaanIds)
            ->select('status')
            ->distinct()
            ->get();

        return view('distributor.permintaan-barang.index', [
            'title' => 'Permintaan Barang',
            'permintaanBarang' => $permintaanBarang,
            'user' => Auth::user()->name,
            'statusList' => $statusList,
        ]);
    }


    public function filter(Request $request)
    {
        $status = $request->input('status');

        // Ambil semua permintaan_id dari distribusi_barang milik distributor yang sedang login
        $permintaanIds = DB::table('distribusi_barangs')
            ->where('distributor_id', Auth::id())
            ->pluck('permintaan_id');

        // Filter permintaan berdasarkan status dan permintaan_id
        $permintaanBarang = PermintaanBarang::whereIn('id', $permintaanIds)
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->whereIn('status', ['Masuk', 'Diproses', 'Selesai'])
            ->get();

        // Ambil status yang tersedia dari data permintaan tersebut
        $statusList = PermintaanBarang::whereIn('id', $permintaanIds)
            ->select('status')
            ->distinct()
            ->get();

        return view('distributor.permintaan-barang.index', [
            'title' => 'Permintaan Barang',
            'user' => Auth::user()->name,
            'permintaanBarang' => $permintaanBarang,
            'statusList' => $statusList,
        ]);
    }
}
