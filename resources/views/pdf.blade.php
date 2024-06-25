<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .total {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Detail Transaksi</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah Beli</th>
                <th>Sub Total</th>
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
    <div class="total">
        <p><strong>Total Barang: {{ $transaksi->total_barang }}</strong></p>
        <p><strong>Grand Total: Rp {{ number_format($transaksi->grand_total, 0, ',', '.') }}</strong></p>
    </div>
</body>
</html>
