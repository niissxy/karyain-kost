@extends('layouts.app')
@section('title', 'Laporan Transaksi Kost Regol 2')
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
                            Tambah Laporan Transaksi Kost Regol 2
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
                        <h5 class="card-title mb-0">Tambah Laporan Transaksi Kost Regol 2</h5>
                        <a class="btn btn-warning btn-sm" href="{{ url('./laptransaksi_regol2') }}">
                            <i class="bi bi-arrow-left-circle-fill"></i> Back
                        </a>
                    </div>

                    <form action="{{ url('laptransaksi_regol2') }}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}

                        <div class="card-body">

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">ID Laporan</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="id_laptransaksi" name="id_laptransaksi" readonly value="{{ $newKode }}">
                            </div>
                        </div>

                             <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">ID Transaksi</label>
                                <div class="col-sm-9">
                                    <select name="id_transaksi" id="id_transaksi" class="form-select mb-3" required>
                                        <option value="">-- Pilih Transaksi --</option>
                                            @foreach ($transaksi as $t)
                                        <option 
                                            value="{{ $t->id_transaksi }}"
                                            data-nama="{{ $t->nama_penyewa }}"
                                            data-kamar="{{ $t->no_kamar }}"
                                            data-nominal="{{ $t->nominal }}"
                                            data-tglbayar="{{ $t->tgl_pembayaran }}"
                                            data-status="{{ $t->status }}"
                                        >
                                            {{ $t->id_transaksi }} - {{ $t->nama_penyewa }}
                                        </option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Penghuni</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="nama_penghuni" name="nama_penghuni" readonly required value="{{ old('nama_penghuni') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">No Kamar</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="no_kamar" name="no_kamar" readonly type="text" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nominal</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="nominal" name="nominal" readonly type="text" required>
                                </div>
                            </div>

                             <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Pembayaran</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="tgl_pembayaran" name="tgl_pembayaran" readonly type="date" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Status Pembayaran</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="status_pembayaran" name="status_pembayaran" readonly type="text" required>
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
document.getElementById('id_transaksi').addEventListener('change', function () {
    const selected = this.options[this.selectedIndex];

    document.getElementById('nama_penghuni').value =
        selected.getAttribute('data-nama') || '';

    document.getElementById('no_kamar').value =
        selected.getAttribute('data-kamar') || '';

    document.getElementById('nominal').value =
        selected.getAttribute('data-nominal') || '';

     document.getElementById('tgl_pembayaran').value =
        selected.getAttribute('data-tglbayar') || '';

    document.getElementById('status_pembayaran').value =
        selected.getAttribute('data-status') || '';
});
</script>


</main> 
@endsection
