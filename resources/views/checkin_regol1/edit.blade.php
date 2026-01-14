@extends('layouts.app')
@section('title', 'Data Check In Kost Regol 1')
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
                            Edit Data Check In Kost Regol 1
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
                        <h5 class="card-title mb-0">Edit Data Check In Kost Regol 1</h5>
                        <a class="btn btn-warning btn-sm" href="{{ url('./checkin_regol1') }}">
                            <i class="bi bi-arrow-left-circle-fill"></i> Back
                        </a>
                    </div>

                    <form action="{{ url('checkin_regol1/' .$checkin_regol1->id_checkin) }}" method="post"  enctype="multipart/form-data">
                        @method('put')
                        {{ csrf_field() }}

                        <div class="card-body">

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">ID Check In</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  readonly  value="{{ old('id_checkin',$checkin_regol1->id_checkin) }}"  name="id_checkin"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Check In</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" value="{{ old('tgl_checkin',$checkin_regol1->tgl_checkin) }}"  name="tgl_checkin"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Penghuni</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly value="{{ old('nama_penghuni',$checkin_regol1->nama_penghuni) }}"  name="nama_penghuni"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">No Kamar</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ old('no_kamar',$checkin_regol1->no_kamar) }}"  name="no_kamar"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nominal</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ old('nominal', number_format($checkin_regol1->nominal ?? 0, 0, ',', '.')) }}"  name="nominal"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="status" name="status">
                                        <option value='Aktif' {{ old('status', $checkin_regol1->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value='Booked' {{ old('status', $checkin_regol1->status) == 'Booked' ? 'selected' : '' }}>Booked</option>
                                        <!-- <option value='Check out' {{ old('status', $checkin_regol1->status) == 'Check out' ? 'selected' : '' }}>Check Out</option>        -->
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
