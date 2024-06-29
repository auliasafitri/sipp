<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            margin-top: 20px;
            font-weight: bold;
            text-align: right;
        }
        .total th, .total td {
            border-top: 2px solid black;
        }
    </style>
</head>
<body>
    <h2>Laporan Rekap Transaksi Koperasi SDN Sarang Halang</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                $total = 0;
            @endphp
            @foreach ($data as $transaksi)
                @foreach ($transaksi->detailTransaksis as $detail)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('d-m-Y') }}</td>
                        <td>{{ $detail->barang->nama_barang ?? 'N/A' }}</td>
                        <td>{{ $detail->jumlah_barang }}</td>
                        <td>Rp{{ number_format($detail->sub_total, 0, ",", ".") }}</td>
                    </tr>
                    @php
                        $total += $detail->sub_total;
                    @endphp
                @endforeach
            @endforeach
            <tr class="total">
                <th colspan="4">Total :</th>
                <td>Rp{{ number_format($total, 0, ",", ".") }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
