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
                        <h4>DETAIL TRANSAKSI</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <p>Dashboard</p>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Detail Transaksi
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
				<div class="pd-20">
					
					{{-- <h4 class="text-blue h4">Data Detail Transaksi</h4> --}}
				<form action="{{ route('cetakRekap') }}" method="GET" class="form-inline">
					<div class="form-group">
						<label for="tanggal_dari">Tanggal Dari:</label>
						<input type="date" name="tanggal_dari" id="tanggal_dari" class="form-control mx-sm-2">
					</div>
					<div class="form-group">
						<label for="tanggal_sampai">Tanggal Sampai:</label>
						<input type="date" name="tanggal_sampai" id="tanggal_sampai" class="form-control mx-sm-2">
					</div>
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-print"></i> Cetak Laporan Rekap
					</button>
				</form>

            <div class="pb-20 pt-2">
                <table class="data-table table stripe hover nowrap mt-5">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">NO</th>
                            <th class="table-plus datatable-nosort">TANGGAL</th>
                            <th class="table-plus datatable-nosort">TOTAL BARANG</th>
                            <th class="table-plus datatable-nosort">TOTAL HARGA</th>
                            @if(session("level")=="admin")
                            <th class="datatable-nosort">AKSI</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $transaksi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('l, j F Y') }}</td>
                            <td>{{ $transaksi->total_barang }}</td>
                            <td>Rp {{ number_format($transaksi->grand_total, 0, ',', '.') }}</td>
                            @if(session("level")=="admin")
                            <td>
                            <a href="{{ route('index.detail', $transaksi->id) }}"
                            class="btn btn-info text-white""><i class="bi bi-eye"></i>Detail</a>
                                        <form action="{{ route('detail-transaksi.destroy', $transaksi->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-white" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')"><i class="bi bi-trash"></i>Hapus</button>
                                        </form>
												{{-- End Delete Button --}}

                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endsection