@extends('layouts.app')
@section('title', 'Data Fasilitas Umum Kost Regol 1')
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
                            Edit Data Fasilitas Umum Kost Regol 1
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
                        <h5 class="card-title mb-0">Edit Data Fasilitas Umum Kost Regol 1</h5>
                        <a class="btn btn-warning btn-sm" href="{{ url('./fasum_regol1') }}">
                            <i class="bi bi-arrow-left-circle-fill"></i> Back
                        </a>
                    </div>

                    <form action="{{ url('fasum_regol1/' .$fasum_regol1->id_fasum) }}" method="post"  enctype="multipart/form-data">
                        @method('put')
                        {{ csrf_field() }}

                        <div class="card-body">

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">ID Fasilitas Umum</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  readonly  value="{{ old('id_fasum',$fasum_regol1->id_fasum) }}"  name="id_fasum"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Fasilitas</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control" value="{{ old('nama_fasilitas',$fasum_regol1->nama_fasilitas) }}"  name="nama_fasilitas" readonly required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Kondisi</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="kondisi" name="kondisi">
                                        <option value='Baik' {{ old('kondisi', $fasum_regol1->status) == 'Baik' ? 'selected' : '' }}>Baik</option>
                                        <option value='Perbaikan' {{ old('kondisi', $fasum_regol1->status) == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                                        <option value='Rusak' {{ old('kondisi', $fasum_regol1->status) == 'Rusak' ? 'selected' : '' }}>Rusak</option>       
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
