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
							<h4>BARANG</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
									<p>Dashboard</p>
								</li>
								<li class="breadcrumb-item active" aria-current="page">
									Barang
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
					<a href="{{ route('barang.create') }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-plus">TAMBAH BARANG</i></a>
					{{-- <h4 class="text-blue h4">Kategori</h4> --}}
					
				</div>
				<div class="pb-20">
					<table class="data-table table stripe hover nowrap">
						<thead>
							<tr>
								<th class="table-plus datatable-nosort">NO</th>
								<th class="table-plus datatable-nosort">KODE</th>
								<th class="table-plus datatable-nosort">BARANG</th>
								<th class="table-plus datatable-nosort">KATEGORI</th>
								<th class="table-plus datatable-nosort">HARGA</th>
								<th class="table-plus datatable-nosort">GAMBAR</th>
								<th class="datatable-nosort">AKSI</th>
							</tr>
						</thead>
						<tbody>
						@php
									$no = 1;
								@endphp
							@foreach ($data as $d)
								<tr>
								<td class="table-plus">{{ $no++ }}</td>
									<td class="table-plus">{{ $d->kd_barang }}</td>
									<td class="table-plus">{{ $d->nama_barang }}</td>
									<td class="table-plus">{{ $d->kategori->nama_kategori ?? 'Tidak ada kategori' }}</td>
									<td class="table-plus">Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
									<td  class="table-plus"><img width="100" src="{{ asset('storage/foto-barang/'.$d->foto) }}" alt=""></td>
									<td>
                                    
                                    <a href="{{ route ('barang.edit',['id_barang'=> $d->id_barang]) }}"
                                    <button class="btn btn-warning text-white"><i class="bi bi-pencil"></i>Edit</button>
                                    </a>

                                    <a href="{{ route('barang.delete',['id_barang'=> $d->id_barang]) }}"
													onclick="event.preventDefault(); confirmDelete('{{ $d->id_barang }}');">
                                                    <button class="btn btn-danger text-white"><i class="bi bi-trash"></i>Hapus</button>
									</a>												
												{{-- Delete Button --}}
												
												 
												 <form id="delete-form-{{ $d->id_barang }}" action="{{ route('barang.delete',['id_barang'=> $d->id_barang]) }}" method="POST" style="display: none;">
													 @csrf
													 @method('DELETE')
												 </form>
												 
												 <script>
												 function confirmDelete(kodelokasi) {
													 if (confirm('Yakin ingin menghapus data ini?')) {
														 document.getElementById('delete-form-' + kodelokasi).submit();
													 }
												 }
												 </script>
												{{-- End Delete Button --}}
											
									</td>
								</tr>
							@endforeach
					
						</tbody>
					</table>
				</div>
			</div>
	</div>

@endsection