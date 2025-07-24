<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanAdminController extends Controller
{
    public function index()
    {
        // Ambil semua data laporan dengan relasi stokBarang untuk mendapatkan satuan
        $laporan = Laporan::with('stokBarang')->orderBy('updated_at', 'desc')->get();

        return view('admin.laporan.index', [
            'title' => 'Laporan',
            'laporan' => $laporan,
        ]);
    }

    public function filter(Request $request)
    {
        // Filter berdasarkan status (masuk/keluar) dan bulan
        $query = Laporan::with('stokBarang');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('bulan') && $request->bulan != '') {
            $query->whereMonth('updated_at', Carbon::parse($request->bulan)->month);
        }

        $laporan = $query->orderBy('updated_at', 'desc')->get();

        return view('admin.laporan.index', [
            'title' => 'Laporan',
            'laporan' => $laporan,
        ]);
    }

    public function export(Request $request)
    {
        // Ambil data laporan berdasarkan filter bulan dan status
        $query = Laporan::with('stokBarang');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('bulan') && $request->bulan != '') {
            $query->whereMonth('updated_at', Carbon::parse($request->bulan)->month)
                ->whereYear('updated_at', Carbon::parse($request->bulan)->year);
        }

        $laporan = $query->orderBy('updated_at', 'desc')->get();

        // Data untuk PDF
        $data = [
            'laporan' => $laporan,
            'bulan' => $request->bulan ? Carbon::parse($request->bulan)->translatedFormat('F Y') : 'Semua Bulan',
            'tanggal_export' => now()->translatedFormat('d F Y H:i:s'),
        ];

        // Generate PDF
        $pdf = Pdf::loadView('admin.laporan.template', $data);

        // Nama file PDF
        $filename = 'laporan_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }
}
