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
                        <h4>Stok Barang<a /h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <p>Home</p>
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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa fa-plus"></i> Tambah Stok
                </button>


            </div>
            <div class="pb-20">

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Stok</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    @csrf 

                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Nama Barang</label>
                                        <select name="id_barang" class="form-select" aria-label="Default select example">
  <option selected>Pilih Barang</option>
  <option value="1">One</option>
</select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label"></label>Jumlah stok Barang
                                        <input name="stok_barang" type="text" class="form-control" placeholder="Jumlah Barang " id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label"></label>Tanggal
                                        <input name="tanggal_stok" type="date" class="form-control" placeholder="Masukkan Tanggal " id="exampleInputPassword1">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No</th>
                            <th class="table-plus datatable-nosort">Nama Barang</th>
                            <th class="table-plus datatable-nosort">Kategori Barang</th>
                            <th class="table-plus datatable-nosort">Harga Barang</th>
                            <th class="table-plus datatable-nosort">Stok Barang</th>
                            <th class="table-plus datatable-nosort">Tanggal</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stok as $no=> $data)
                        <tr>
                            <td class="table-plus">{{$no+=1}}</td>
                            <td class="table-plus">{{$data->nama_barang}}</td>
                            <td class="table-plus">{{$data->nama_kategori}}</td>
                            <td class="table-plus">Rp {{$data->harga}}</td>
                            <td class="table-plus"> {{$data->stok_barang}}</td>
                            <td class="table-plus">{{$data->tanggal_stok}}</td>
                            <td class="table-plus d-flex">
                                <button class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#Editmodal"><i class="bi bi-pencil"></i>Edit</button>
                                <form action="/stok/hapus" method="post">
                                    @csrf
                                    <input type="hidden" name="id_stok" value="{{$data->id_stok}}" />
                                    <button class="btn btn-danger text-white" onclick="confirm('Apakah anda ingin menghapus data ini?')"><i class="bi bi-trash"></i>Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <div class="modal fade" id="Editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Form Edit Stok</h5>
                                        <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="post">
                                    @csrf 

                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Nama Barang</label>
                                        <select name="id_barang" class="form-select" aria-label="Default select example">
  <option selected>Pilih Barang</option>
  <option value="1">One</option>
</select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label"></label>Jumlah stok Barang
                                        <input name="stok_barang" type="text" class="form-control" placeholder="Jumlah Barang " id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label"></label>Tanggal
                                        <input name="tanggal_stok" type="date" class="form-control" placeholder="Masukkan Tanggal " id="exampleInputPassword1">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </tbody>
                </table>
            </div>
        </div>
        <!-- Simple Datatable End -->
        {{-- <!-- multiple select row Datatable start -->
		
			<!-- multiple select row Datatable End -->
		
			<!-- Checkbox select Datatable End -->
			<!-- Export Datatable start -->

			<!-- Export Datatable End --> --}}
    </div>
    <!-- <div class="footer-wrap pd-20 mb-20 card-box">
			DeskApp - Bootstrap 4 Admin Template By
			<a href="https://github.com/dropways" target="_blank"
				>Ankit Hingarajiya</a
			>
		</div> -->
</div>

@endsection