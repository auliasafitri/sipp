@extends('layouts.main')

@section('content')
<div class="pd-ltr-20">
	<div class="card-box pd-20 height-100-p mb-30">
		<div class="row align-items-center">
			<div class="col-md-4 text-center">
				<img width="200px" src="fiani.png" alt="" />
			</div>
			<div class="col-md-8">
				<h4 class="font-20 weight-500 mb-10 text-capitalize">
					Selamat Datang
					@if(session("level")=="admin")
					<div class="weight-600 font-30 text-blue">Admin!</div>
					@endif
					@if(session("level")=="kepsek")
					<div class="weight-600 font-30 text-blue">Kepala Sekolah!</div>
					@endif
					@if(session("level")=="bendahara")
					<div class="weight-600 font-30 text-blue">Bendahara!</div>
					@endif
				</h4>

				<p class="font-18 max-width-600">
					Sistem Informasi Pendataan Penjualan Koperasi SDN Sarang Halang
				</p>
			</div>
		</div>
	</div>
	<div class="row">

		<div class="col-xl-3 mb-30">
			<div class="card-box pt-4 pb-4 height-100-p widget-style1" style="background-color:#90CAF9;">
				<div class="d-flex flex-wrap align-items-center">

					<div class="row">

						<div class="col-6">
							<h1><span class="micon bi bi-boxes ml-5"></span></h1>
						</div>
						<div class="col-6">
							<div class="h4 mb-0 ml-3">{{$barang}}</div>
							<div class="weight-600 font-14 ml-3">Barang</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 mb-30">
			<div class="card-box pt-4 pb-4 height-100-p widget-style1" style="background-color:#A5D6A7;">
				<div class="d-flex flex-wrap align-items-center">

					<div class="row">

						<div class="col-6">
							<h1><span class="micon bi bi-boxes ml-5"></span></h1>
						</div>
						<div class="col-6">
							<div class="h4 mb-0 ml-3">{{$stok}}</div>
							<div class="weight-600 font-14 ml-3">Stok</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 mb-30">
			<div class="card-box pt-4 pb-4 height-100-p widget-style1" style="background-color:#FFCCBC;">
				<div class="d-flex flex-wrap align-items-center">

					<div class="row">

						<div class="col-6">
							<h1><span class="micon bi bi-boxes ml-5"></span></h1>
						</div>
						<div class="col-6">
							<div class="h4 mb-0 ml-3">{{$kategori}}</div>
							<div class="weight-600 font-14 ml-3">Kategori</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 mb-30">
			<div class="card-box pt-4 pb-4 height-100-p widget-style1" style="background-color:#EF9A9A;">
				<div class="d-flex flex-wrap align-items-center">

					<div class="row">

						<div class="col-6">
							<h1><span class="micon bi bi-boxes ml-5"></span></h1>
						</div>
						<div class="col-6">
							<div class="h4 mb-0 ml-3">{{$akun}}</div>
							<div class="weight-600 font-14 ml-3">Akun</div>
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>

	<!-- <div class="footer-wrap pd-20 mb-20 card-box">
		DeskApp - Bootstrap 4 Admin Template By
		<a href="https://github.com/dropways" target="_blank"
			>Ankit Hingarajiya</a
		>
	</div> -->
</div>
@endsection