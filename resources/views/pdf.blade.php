<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .table-container {
            width: 100%;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .total {
            margin-top: 20px;
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Struk Transaksi</h2>
            <p>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 10%;">No</th>
                        <th style="width: 40%;">Nama Barang</th>
                        <th style="width: 20%;">Jumlah</th>
                        <th style="width: 30%;">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi->detailTransaksis as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detail->barang->nama_barang ?? 'N/A' }}</td>
                        <td>{{ $detail->jumlah_barang }}</td>
                        <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="total">
            <p><strong>Total Barang: {{ $transaksi->total_barang }}</strong></p>
            <p><strong>Grand Total: Rp {{ number_format($transaksi->grand_total, 0, ',', '.') }}</strong></p>
        </div>
        <hr style="border-top: 1px dashed #ccc;">
        <p style="text-align: center;">Terima kasih atas kunjungan Anda</p>
    </div>
</body>
</html>
