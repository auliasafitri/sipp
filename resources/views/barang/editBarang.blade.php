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
                            <h4>EDIT BARANG</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/dashboard">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="/kategori">Barang</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Edit Barang
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="card-box mb-30">
                <div class="pd-20">
                    <form action="{{ route('barang.update', ['id_barang'=> $data->id_barang]) }}"  method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" value="{{$data->nama_barang}}" id="exampleInputnama_barang1"
                                placeholder="Masukkan Nama Barang">
                            @error('nama_barang')
                            <small color="red"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori</label>
                            <select class="form-control" name="id_kategori">
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                            <small style="color: red;"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="text" class="form-control" name="harga" value="{{$data->harga}}" id="exampleInputEmail1"
                                placeholder="Enter harga">
                            @error('harga')
                            <small color="red"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Foto</label>
                            <input type="file" class="form-control" name="foto" value= "{{$data->foto}}" id="exampleInputFile"
                                placeholder="Enter foto">
                            @error('foto')
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
