<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DistribusiBarang;
use App\Models\PermintaanBarang;
use App\Models\StokBarang;

class DistribusiBarangDistributorController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'gudang') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil distribusi_barang berdasarkan distributor_id
        $distribusiBarang = DistribusiBarang::whereIn('distributor_id', Auth::user()->id)->get();

        // Ambil semua status unik untuk filter (opsional)
        $statusList = DistribusiBarang::select('status')->distinct()->get();

        return view('gudang.distribusi-barang.index', [
            'title' => 'Distribusi Barang',
            'distribusiBarang' => $distribusiBarang,
            'user' => Auth::user()->name,
            'statusList' => $statusList,
        ]);
    }

    public function filter(Request $request)
    {
        $status = $request->input('status');

        $distribusiBarang = DistribusiBarang::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->whereIn('status', ['Proses Pengiriman', 'Selesai', 'Gagal'])->get();

        $statusList = DistribusiBarang::select('status')
            ->distinct()
            ->get();

        return view('gudang.distribusi-barang.index', [
            'title' => 'Distribusi Barang',
            'user' => Auth::user()->name,
            'distribusiBarang' => $distribusiBarang,
            'statusList' => $statusList,
        ]);
    }

    public function show($id)
    {
        // Ambil distribusi barang berdasarkan ID
        $distribusiBarang = DistribusiBarang::with('distributor', 'permintaanBarang')->findOrFail($id);

        return view('gudang.distribusi-barang.show', [
            'title' => 'Detail Distribusi Barang',
            'distribusiBarang' => $distribusiBarang,
            'permintaanBarang' => $distribusiBarang->permintaanBarang, // Relasi ke permintaan barang
        ]);
    }
}
