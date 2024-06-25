@extends('layouts.main')

@section('content')

<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">

        {{-- Notofikasi --}}
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        {{-- End Notifikasi --}}

        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>TRANSAKSI</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <p>Dashboard</p>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Transaksi
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                    </div>
                </div>
            </div>
        </div>
        <!-- Simple Datatable start -->
        <div class="card-box mb-30">

            <div class="pb-20 pt-2">
                <table class="data-table table stripe hover nowrap mt-5">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">NO</th>
                            <th class="table-plus datatable-nosort">TANGGAL</th>
                            <th class="table-plus datatable-nosort">TOTAL BARANG</th>
                            <th class="table-plus datatable-nosort">TOTAL HARGA</th>
                            <th class="datatable-nosort">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $transaksi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('l, j F Y') }}</td>
                            <td>{{ $transaksi->total_barang }}</td>
                            <td>Rp {{ number_format($transaksi->grand_total, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('latief.show', $transaksi->id) }}"
                                    class="btn btn-sm btn-info">Detail</a>
                                {{-- <form action="{{ route('transaksi.delete', $transaksi->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Hapus</button>
                                </form> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endsection