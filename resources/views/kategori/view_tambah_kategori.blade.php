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
                            <h4>TAMBAH KATEGORI</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/dashboard">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="/kategori">Kategori</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Tambah Kategori
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="card-box mb-30">
                <div class="pd-20">
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori</label>
                            <input type="text" class="form-control" name="nama_kategori" id="exampleInputnama_barang1"
                                placeholder="Masukkan Nama Kategori">
                            @error('nama_kategori')
                            <small color="red"> {{ $message }} </small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/kategori" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
