<!-- filepath: d:\laragon\www\tani-desa\resources\views\admin\laporan\pdf.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    <div style="display: flex; align-items: center; justify-content: center; text-align: center; margin-bottom: 10px;">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="height: 60px; margin-right: 10px;">
        <h1 style="font-size: 32px; font-weight: bold; color: #2d6a4f;">TaniDesa</h1>
    </div>
    <p style="font-size: 24px; margin-top: 3px; text-align: center;">Laporan Barang Masuk dan Keluar</p>

    <div class="info">
        <p><strong>Laporan Bulan:</strong> {{ $bulan }}</p>
        <p><strong>Diekspor Pada:</strong> {{ $tanggal_export }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data laporan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
