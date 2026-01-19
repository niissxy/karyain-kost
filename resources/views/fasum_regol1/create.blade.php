@extends('layouts.app')
@section('title', 'Data Fasilitas Umum Kost Regol 1')
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
                            Tambah Data Fasilitas Umum Kost Cibiru 1
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
                        <h5 class="card-title mb-0">Tambah Data Fasilitas Umum Kost Regol 1</h5>
                        <a class="btn btn-warning btn-sm" href="{{ url('./fasum_regol1') }}">
                            <i class="bi bi-arrow-left-circle-fill"></i> Back
                        </a>
                    </div>

                    <form action="{{ url('fasum_regol1') }}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}

                        <div class="card-body">

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">ID Fasilitas Umum</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="id_fasum" required value="{{ $newKode }}" readonly>
                                </div>
                            </div>

                           <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Fasilitas</label>
                           <div class="col-sm-9">
                                <select name="nama_fasilitas" id="nama_fasilitas" class="form-select" required>
                                    <option value="">-- Pilih Fasilitas Umum --</option>
                                    @foreach ($asetFasilitasUmum as $aset)
                                    <option value="{{ $aset->nama_aset }}"
                                    data-kondisi="{{ $aset->kondisi }}">
                                        {{ $aset->nama_aset }}
                                    </option>
                                    @endforeach
                                </select>
                           </div>
                           </div>

                           <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Kondisi</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="kondisi" id="kondisi" type="text" required readonly>
                                    <!-- <select class="form-select" name="kondisi">
                                        <option value="">-- Pilih Kondisi --</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Perbaikan">Perbaikan</option>
                                        <option value="Rusak">Rusak</option>
                                    </select> -->
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
<script>
    document.getElementById('nama_fasilitas').addEventListener('change', function () {
        const selected = this.options[this.selectedIndex]

        document.getElementById('kondisi').value=
        selected.getAttribute('data-kondisi') || '';
    })
</script>
</main> 
@endsection
