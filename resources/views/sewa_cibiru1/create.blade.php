@extends('layouts.app')
@section('title', 'Data Sewa Kost Cibiru 1')
@section('content')

<style>
    html, body {
    max-width: 100%;
    overflow-x: hidden;
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
                            Tambah Data Sewa Kost Cibiru 1
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
                        <h5 class="card-title mb-0">Tambah Data Sewa Kost Cibiru 1</h5>
                        <a class="btn btn-warning btn-sm" href="{{ url('./sewa_cibiru1') }}">
                            <i class="bi bi-arrow-left-circle-fill"></i> Back
                        </a>
                    </div>

                    <form action="{{ url('sewa_cibiru1') }}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}

                        <div class="card-body">

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">ID Sewa</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="id_sewa" required value="{{ old('id_sewa') }}">
                                </div>
                            </div>

                           <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Penyewa</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="nama_penyewa" type="text" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Durasi Sewa</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="durasi_sewa" type="text" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Mulai</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="tgl_mulai" type="date" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Berakhir</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="tgl_berakhir" type="date" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Jatuh Tempo</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="jatuh_tempo" type="date" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Perpanjangan</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="perpanjangan" type="text" required>
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
