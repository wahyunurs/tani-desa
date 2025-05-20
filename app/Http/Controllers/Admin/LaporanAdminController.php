<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Carbon\Carbon;

class LaporanAdminController extends Controller
{
    public function index()
    {
        // Ambil semua data laporan
        $laporan = Laporan::orderBy('updated_at', 'desc')->get();

        return view('admin.laporan.index', [
            'title' => 'Laporan',
            'laporan' => $laporan,
        ]);
    }

    public function filter(Request $request)
    {
        // Filter berdasarkan status (masuk/keluar) dan bulan
        $query = Laporan::query();

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

    public function export()
    {
        // Ambil semua data laporan
        $laporan = Laporan::orderBy('updated_at', 'desc')->get();

        // Buat file CSV
        $filename = 'laporan_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($laporan) {
            $file = fopen('php://output', 'w');
            // Header kolom
            fputcsv($file, ['ID', 'Nama Barang', 'Jumlah', 'Status', 'Tanggal']);

            // Data laporan
            foreach ($laporan as $item) {
                fputcsv($file, [
                    $item->id,
                    $item->nama_barang,
                    $item->jumlah,
                    $item->status,
                    $item->updated_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
