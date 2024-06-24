@extends('layouts.main')

@section('content')
<div class="container-fluid">

    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>DETAIL TRANSAKSI <strong style="color: blue;"> [ {{
                            \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('l, j F Y')
                            }} ]</strong></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/transaksi">Transaksi</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Detail Transaksi
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card-box mb-30">
                <div class="card-body p-0">

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
                    <div class="mt-3 ml-5">
                        <p><strong> Total Barang: {{ $transaksi->total_barang }}</strong></p>
                        <p><strong> Grand Total: Rp {{ number_format($transaksi->grand_total, 0, ',', '.')
                                }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection