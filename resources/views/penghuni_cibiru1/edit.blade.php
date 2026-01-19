@extends('layouts.app')
@section('title', 'Data Penghuni Kost Cibiru 1')
@section('content')

<style>
    html, body {
    max-width: 100%;
    overflow-x: hidden;
    font-size: 14px;
}

</style>
<main id="main" class="main">  
    <div class="app-content-header"> 
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-sm-6">
                </div>
                <div class="col-md-10">
                    <ol class="breadcrumb float-md-end small mb-4 mt-4">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Edit Data Penghuni Kost Cibiru 1
                        </li>
                    </ol>
                </div>
            </div> 
        </div> 
    </div>
         
    <section class="section dashboard mt-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">

                <div class="card card-warning card-outline">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Edit Data Penghuni Kost Cibiru 1</h5>
                        <a class="btn btn-warning btn-sm" href="{{ url('./penghuni_cibiru1') }}">
                            <i class="bi bi-arrow-left-circle-fill"></i> Back
                        </a>
                    </div>

                    <form action="{{ url('penghuni_cibiru1/' .$penghuni_cibiru1->id_penghuni) }}" method="post"  enctype="multipart/form-data">
                        @method('put')
                        {{ csrf_field() }}

                        <div class="card-body">

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">ID Penghuni</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  readonly  value="{{ old('id_penghuni',$penghuni_cibiru1->id_penghuni) }}"  name="id_penghuni"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Penghuni</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly value="{{ old('nama_penghuni',$penghuni_cibiru1->nama_penghuni) }}"  name="nama_penghuni"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Status Penghuni</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="status_penghuni" name="status_penghuni">
                                        <option value='Mahasiswa' {{ old('status_penghuni', $penghuni_cibiru1->status_penghuni) == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                        <option value='Non mahasiswa' {{ old('status_penghuni', $penghuni_cibiru1->status_penghuni) == 'Non mahasiswa' ? 'selected' : '' }}>Non mahasiswa</option>       
                                    </select>  
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Penempatan Kamar</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ old('penempatan_kamar',$penghuni_cibiru1->penempatan_kamar) }}"  name="penempatan_kamar"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ old('alamat',$penghuni_cibiru1->alamat) }}"  name="alamat"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Kontak</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ old('kontak',$penghuni_cibiru1->kontak) }}"  name="kontak"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Masuk</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" value="{{ old('tgl_masuk',$penghuni_cibiru1->tgl_masuk) }}"  name="tgl_masuk"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Keluar</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" value="{{ old('tgl_keluar',$penghuni_cibiru1->tgl_keluar) }}"  name="tgl_keluar" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="status" name="status">
                                        <option value='Masih di kost' {{ old('status', $penghuni_cibiru1->status) == 'Masih di kost' ? 'selected' : '' }}>Masih di kost</option>
                                        <option value='Keluar Kost' {{ old('status', $penghuni_cibiru1->status) == 'Keluar Kost' ? 'selected' : '' }}>Keluar Kost</option>       
                                    </select>  
                                </div>
                            </div>

                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save"></i> Save
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

</main> 
@endsection
