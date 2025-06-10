<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StokBarang;

class GudangController extends Controller
{
    public function index()
    {
        // Periksa apakah pengguna memiliki role gudang
        if (Auth::user()->role !== 'gudang') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Periksa stok barang yang menipis
        $stokMenipis = StokBarang::where('jumlah', '<=', 10)->get();

        if ($stokMenipis->isNotEmpty()) {
            session()->flash('warning', 'Ada stok barang yang hampir habis.');
        }

        return view('gudang.index', [
            'title' => 'Dashboard Gudang',
            'user' => Auth::user()->name,
        ]);
    }
}
