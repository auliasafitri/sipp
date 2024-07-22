<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin: 20px 0;
            padding: 10px;
            border-bottom: 2px solid black;
        }

        .header img {
            position: absolute;
            left: 20px;
            width: 75px;
            height: 75px;
        }

        .header .text {
            text-align: center;
            margin-left: 100px;
            flex: 1;
        }

        .header h2 {
            margin: 0;
            font-size: 20px;
        }

        .header p {
            margin: 5px 0 0;
            color: #555;
            font-size: 12px;
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

        .signature {
            margin-top: 40px;
            text-align: right;
        }

        .signature p {
            margin: 0;
        }

        .signature .name {
            margin-top: 80px;
        }

        .date {
            text-align: right;
            margin-top: 20px;
        }

        /* Specific style for the report title */
        .report-title {
            font-size: 16px; /* Adjust font size here */
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="vendors/images/logo_koperasi.png" alt="Logo">
        <div class="text">
            <h2>KOPERASI SEKOLAH</h2>
            <h2>UPTD SD NEGERI SARANG HALANG</h2>
            <p>Jl. Ambawang, Sarang Halang, Kec. Pelaihari, Kab. Tanah Laut, Kalimantan Selatan, 70815</p>
        </div>
    </div>

    <h2 class="report-title" style="text-align: center;">Laporan Rekap Penjualan Koperasi Sekolah</h2>
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

    <div class="signature">
        <p>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
        <p>Mengetahui,</p>
        <p>Kepala Sekolah SD Negeri Sarang Halang</p>
        <div class="name">
            <p>__________________________</p>
            <p><strong>Ely Suryani S.Pd, SD</strong></p>
            <p>NIP. 198602032010012013</p>
        </div>
    </div>
</body>
</html>
