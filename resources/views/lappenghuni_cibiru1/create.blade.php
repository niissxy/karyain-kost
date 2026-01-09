@extends('layouts.app')
@section('title', 'Laporan Penghuni Kost Cibiru 1')
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
                            Tambah Laporan Penghuni Kost Cibiru 1
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
                        <h5 class="card-title mb-0">Tambah Laporan Penghuni Kost Cibiru 1</h5>
                        <a class="btn btn-warning btn-sm" href="{{ url('./lappenghuni_cibiru1') }}">
                            <i class="bi bi-arrow-left-circle-fill"></i> Back
                        </a>
                    </div>

                    <form action="{{ url('lappenghuni_cibiru1') }}" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}

    <div class="card-body">

    <div class="row mb-3">
            <label class="col-sm-3 col-form-label">ID Laporan</label>
            <div class="col-sm-9">
                <input class="form-control" id="id_lappenghuni" name="id_lappenghuni" readonly value="{{ $newKode }}">
            </div>
    </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">ID Penghuni</label>
            <div class="col-sm-9">
                <select name="id_penghuni" id="id_penghuni" class="form-select mb-3" required>
                    <option value="">-- Pilih Data Penghuni --</option>
                        @foreach ($penghuni_cibiru1 as $p)
                    <option 
                        value="{{ $p->id_penghuni }}"
                        data-nama="{{ $p->nama_penghuni }}"
                        data-tglmasuk="{{ $p->tgl_masuk }}"
                        data-tglkeluar="{{ $p->tgl_keluar }}"
                        data-durasi="{{ $p->durasi_sewa }}"
                        data-status="{{ $p->status_penghuni }}">
                        {{ $p->id_penghuni }} - {{ $p->nama_penghuni }}
                    </option>
                        @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nama Penghuni</label>
            <div class="col-sm-9">
                <input class="form-control" id="nama_penghuni" name="nama_penghuni" readonly value="{{ old('nama_penghuni') }}">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Tanggal Masuk</label>
            <div class="col-sm-9">
                <input class="form-control" id="tgl_masuk" name="tgl_masuk" readonly type="date">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Tanggal Keluar</label>
            <div class="col-sm-9">
                <input class="form-control" id="tgl_keluar" name="tgl_keluar" readonly type="date">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Durasi Sewa</label>
            <div class="col-sm-9">
                <input class="form-control" id="durasi_sewa" name="durasi_sewa" readonly type="text">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-9">
                <input class="form-control" id="status_penghuni" name="status_penghuni" readonly type="text">
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
document.getElementById('id_penghuni').addEventListener('change', function () {
    const selected = this.options[this.selectedIndex];

    document.getElementById('nama_penghuni').value =
        selected.getAttribute('data-nama') || '';

    document.getElementById('tgl_masuk').value =
        selected.getAttribute('data-tglmasuk') || '';

    document.getElementById('tgl_keluar').value =
        selected.getAttribute('data-tglkeluar') || '';

    document.getElementById('durasi_sewa').value =
        selected.getAttribute('data-durasi') || '';

    document.getElementById('status_penghuni').value =
        selected.getAttribute('data-status') || '';

});

document.addEventListener('DOMContentLoaded', function () {
    const tglMasuk = document.getElementById('tgl_masuk');
    const tglKeluar = document.getElementById('tgl_keluar');
    const durasi = document.getElementById('durasi_sewa');

    function hitungDurasi() {
        if (tglMasuk.value && tglKeluar.value) {
            const masuk = new Date(tglMasuk.value);
            const keluar = new Date(tglKeluar.value);

            let bulan =
                (keluar.getFullYear() - masuk.getFullYear()) * 12 +
                (keluar.getMonth() - masuk.getMonth());

            if (keluar.getDate() < masuk.getDate()) {
                bulan--;
            }

            durasi.value = bulan > 0 ? bulan + ' bulan' : 'Kurang dari 1 bulan';
        } else {
            durasi.value = '';
        }
    }

    tglMasuk.addEventListener('change', hitungDurasi);
    tglKeluar.addEventListener('change', hitungDurasi);
});
</script>


</main> 
@endsection
