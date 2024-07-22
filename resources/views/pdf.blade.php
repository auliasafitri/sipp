<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 0;
        }
        .header p {
            margin: 5px 0 0;
            color: #888;
        }
        .transaction-code {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #333;
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
        th {
            background-color: #f0f0f0;
        }
        .total {
            margin-top: 20px;
            font-weight: bold;
            text-align: right;
            color: #333;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
        .footer hr {
            border-top: 1px dashed #ccc;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="vendors/images/logo_koperasi.png" alt="Logo">
            <h2>Koperasi SDN Sarang Halang</h2>
            <p>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
        </div>
        <div class="transaction-code">
            <p><strong>Kode Transaksi: {{ $transaksi->kd_transaksi }}</strong></p>
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
            <p>Total Barang: {{ $transaksi->total_barang }}</p>
            <p>Grand Total: Rp {{ number_format($transaksi->grand_total, 0, ',', '.') }}</p>
        </div>
        <div class="footer">
            <hr>
            <p>Terima kasih atas kunjungan Anda</p>
        </div>
    </div>
</body>
</html>
