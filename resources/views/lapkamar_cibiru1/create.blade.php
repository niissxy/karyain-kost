@extends('layouts.app')
@section('title', 'Laporan Kamar Kost Cibiru 1')
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
                            Tambah Laporan Kamar Kost Cibiru 1
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
                        <h5 class="card-title mb-0">Tambah Laporan Kamar Kost Cibiru 1</h5>
                        <a class="btn btn-warning btn-sm" href="{{ url('./lapkamar_cibiru1') }}">
                            <i class="bi bi-arrow-left-circle-fill"></i> Back
                        </a>
                    </div>

                    <form action="{{ url('lapkamar_cibiru1') }}" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}

    <div class="card-body">

    <div class="row mb-3">
            <label class="col-sm-3 col-form-label">ID Laporan </label>
            <div class="col-sm-9">
                <input class="form-control" id="id_lapkamar" name="id_lapkamar" readonly value="{{ $newKode }}" readonly>
            </div>
    </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">ID Penghuni</label>
            <div class="col-sm-9">
                <select name="id_kamar" id="id_kamar" class="form-select" required>
                            <option value="">-- Pilih Kamar --</option>
                            @foreach($lapkamar_cibiru1 as $k)
                                <option 
                                    value="{{ $k->id_kamar }}"
                                    data-nokamar="{{ $k->no_kamar }}"
                                    data-tipe="{{ $k->tipe_kamar }}"
                                    data-status="{{ $k->status_kamar }}"
                                    data-harga-harian="{{ $k->harga_harian }}"
                                    data-harga-bulanan="{{ $k->harga_bulanan }}"
                                >
                                    {{ $k->id_kamar }} - {{ $k->no_kamar }}
                                </option>
                            @endforeach
                        </select>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">No Kamar</label>
            <div class="col-sm-9">
                <input class="form-control" id="no_kamar" name="no_kamar" readonly value="{{ old('no_kamar') }}">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Tipe Kamar</label>
            <div class="col-sm-9">
                <input class="form-control" id="tipe_kamar" name="tipe_kamar" readonly type="text">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Harga Harian</label>
            <div class="col-sm-9">
                <input class="form-control" id="harga_harian" name="harga_harian" readonly type="number">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Harga Bulanan</label>
            <div class="col-sm-9">
                <input class="form-control" id="harga_bulanan" name="harga_bulanan" readonly type="number">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Status Kamar</label>
            <div class="col-sm-9">
                <input class="form-control" id="status_kamar" name="status_kamar" readonly type="text">
            </div>
        </div>

    </div>
    <!-- Tutup card-body -->

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
document.getElementById('id_kamar').addEventListener('change', function () {
    const selected = this.options[this.selectedIndex];

    document.getElementById('no_kamar').value =
        selected.getAttribute('data-nokamar') || '';

    document.getElementById('tipe_kamar').value =
        selected.getAttribute('data-tipe') || '';

    document.getElementById('status_kamar').value =
        selected.getAttribute('data-status') || '';

    document.getElementById('harga_harian').value =
        selected.getAttribute('data-harga-harian') || '';

    document.getElementById('harga_bulanan').value =
        selected.getAttribute('data-harga-bulanan') || '';

});
</script>


</main> 
@endsection
