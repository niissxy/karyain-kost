@extends('layouts.app')
@section('title', 'Data Kamar Kost Regol 1')
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
                            Edit Data Kamar Kost Regol 1
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
                        <h5 class="card-title mb-0">Edit Data Kamar Kost Regol 1</h5>
                        <a class="btn btn-warning btn-sm" href="{{ url('./kamar_regol1') }}">
                            <i class="bi bi-arrow-left-circle-fill"></i> Back
                        </a>
                    </div>

                    <form action="{{ url('kamar_regol1/' .$kamar_regol1->id_kamar) }}" method="post"  enctype="multipart/form-data">
                        @method('put')
                        {{ csrf_field() }}

                        <div class="card-body">

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">ID Kamar</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  readonly  value="{{ old('id_kamar',$kamar_regol1->id_kamar) }}"  name="id_kamar"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tipe Kamar</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="tipe_kamar" name="tipe_kamar">
                                        <option value='Tunggal' {{ old('tipe_kamar', $kamar_regol1->tipe_kamar) == 'Tunggal' ? 'selected' : '' }}>Tunggal</option>
                                        <option value='Berdua' {{ old('tipe_kamar', $kamar_regol1->tipe_kamar) == 'Berdua' ? 'selected' : '' }}>Berdua</option>       
                                    </select>  
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">No Kamar</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly value="{{ old('no_kamar',$kamar_regol1->no_kamar) }}"  name="no_kamar"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Status Kamar</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="status_kamar" name="status_kamar">
                                        <option value='Booked' {{ old('status_kamar', $kamar_regol1->status_kamar) == 'Booked' ? 'selected' : '' }}>Booked</option>
                                        <option value='Kosong' {{ old('status_kamar', $kamar_regol1->status_kamar) == 'Kosong' ? 'selected' : '' }}>Kosong</option>
                                        <option value='Terisi' {{ old('status_kamar', $kamar_regol1->status_kamar) == 'Terisi' ? 'selected' : '' }}>Terisi</option>        
                                    </select>  
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Harga</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" value="{{ old('harga',$kamar_regol1->harga) }}"  name="harga"  required autofocus>
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
