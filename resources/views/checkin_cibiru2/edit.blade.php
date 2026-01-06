@extends('layouts.app')
@section('title', 'Data Check In Kost Cibiru 2')
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
                            Edit Data Check In Kost Cibiru 2
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
                        <h5 class="card-title mb-0">Edit Data Check In Kost Cibiru 2</h5>
                        <a class="btn btn-warning btn-sm" href="{{ url('./checkin_cibiru2') }}">
                            <i class="bi bi-arrow-left-circle-fill"></i> Back
                        </a>
                    </div>

                    <form action="{{ url('checkin_cibiru2/' .$checkin_cibiru2->id_checkin) }}" method="post"  enctype="multipart/form-data">
                        @method('put')
                        {{ csrf_field() }}

                        <div class="card-body">

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">ID Check In</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  readonly  value="{{ old('id_checkin',$checkin_cibiru2->id_checkin) }}"  name="id_checkin"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Check In</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" value="{{ old('tgl_checkin',$checkin_cibiru2->tgl_checkin) }}"  name="tgl_checkin"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Penghuni</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ old('nama_penghuni',$checkin_cibiru2->nama_penghuni) }}"  name="nama_penghuni"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Lama Tinggal</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ old('lama_tinggal',$checkin_cibiru2->lama_tinggal) }}"  name="lama_tinggal"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="status" name="status">
                                        <option value='Aktif' {{ old('status', $checkin_cibiru2->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value='Booked' {{ old('status', $checkin_cibiru2->status) == 'Booked' ? 'selected' : '' }}>Booked</option>
                                        <option value='Check in' {{ old('status', $checkin_cibiru2->status) == 'Check in' ? 'selected' : '' }}>Check In</option>
                                        <option value='Check out' {{ old('status', $checkin_cibiru2->status) == 'Check out' ? 'selected' : '' }}>Check Out</option>       
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
