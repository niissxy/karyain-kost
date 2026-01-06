@extends('layouts.app')
@section('title', 'Data Sewa Kost Regol 1')
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
                            Edit Data Sewa Kost Regol 1
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
                        <h5 class="card-title mb-0">Edit Data Sewa Kost regol 1</h5>
                        <a class="btn btn-warning btn-sm" href="{{ url('./sewa_regol1') }}">
                            <i class="bi bi-arrow-left-circle-fill"></i> Back
                        </a>
                    </div>

                    <form action="{{ url('sewa_regol1/' .$sewa_regol1->id_sewa) }}" method="post"  enctype="multipart/form-data">
                        @method('put')
                        {{ csrf_field() }}

                        <div class="card-body">

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">ID Sewa</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  readonly  value="{{ old('id_sewa',$sewa_regol1->id_sewa) }}"  name="id_sewa"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Penyewa</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ old('nama_penyewa',$sewa_regol1->nama_penyewa) }}"  name="nama_penyewa"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Durasi Penyewa</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ old('durasi_sewa',$sewa_regol1->durasi_sewa) }}"  name="durasi_sewa"  required autofocus>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Mulai</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" value="{{ old('tgl_mulai',$sewa_regol1->tgl_mulai) }}"  name="tgl_mulai"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Berakhir</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" value="{{ old('tgl_berakhir',$sewa_regol1->tgl_berakhir) }}"  name="tgl_berakhir"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Jatuh Tempo</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" value="{{ old('jatuh_tempo',$sewa_regol1->jatuh_tempo) }}"  name="jatuh_tempo"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Perpanjangan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ old('perpanjangan',$sewa_regol1->perpanjangan) }}"  name="perpanjangan"  required autofocus>
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
