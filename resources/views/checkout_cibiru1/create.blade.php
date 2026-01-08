@extends('layouts.app')
@section('title', 'Data Check Out Kost Cibiru 1')
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
                            Tambah Data Check Out Kost Cibiru 1
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
                        <h5 class="card-title mb-0">Tambah Data Check Out Kost Cibiru 1</h5>
                        <a class="btn btn-warning btn-sm" href="{{ url('./checkout_cibiru1') }}">
                            <i class="bi bi-arrow-left-circle-fill"></i> Back
                        </a>
                    </div>

                    <form action="{{ url('checkout_cibiru1') }}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}

                        <div class="card-body">

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">ID Check Out</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="id_checkout" name="id_checkout" value="{{ $newKode }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">ID Check In</label>
                                <div class="col-sm-9">
                                <select id="id_checkin" name="id_checkin" class="form-control">
                                    <option value="">-- Pilih Checkin --</option>

                                    @foreach($checkin as $c)
                                    <option
                                        value="{{ $c->id_checkin }}"
                                        data-nama="{{ $c->nama_penghuni }}"
                                        data-kamar="{{ $c->no_kamar }}"
                                        data-status="{{ $c->status }}"
                                        data-tgl="{{ $c->tgl_checkin }}"
                                    >
                                        {{ $c->id_checkin }} - {{ $c->nama_penghuni }}
                                    </option>
                                    @endforeach
                                </select>
                                </div>
                           </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Check Out</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="date" id="tgl_checkout" onchange="hitungLamaTinggal(this.value)" name="tgl_checkout" value="{{ old('tgl_checkout') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Penghuni</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="nama_penghuni" name="nama_penghuni" value="{{ old('nama_penghuni') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Lama Tinggal</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="lama_tinggal" name="lama_tinggal" value="{{ old('lama_tinggal') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">No Kamar</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="no_kamar" name="no_kamar" value="{{ old('no_kamar') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="status" name="status" value="{{ old('status') }}">
                                </div>
                            </div>

                           <!-- <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="status" name="status">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Booked">Booked</option>
                                        <option value="Check out">Check Out</option>
                                    </select>
                                </div>
                            </div> -->

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
document.getElementById('id_checkin').addEventListener('change', function () {
    let opt = this.options[this.selectedIndex];

    if (!opt.value) return;

    document.getElementById('nama_penghuni').value = opt.dataset.nama;
    document.getElementById('no_kamar').value = opt.dataset.kamar;
    document.getElementById('status').value = opt.dataset.status;

    // Hitung lama tinggal
    let tglCheckin = new Date(opt.dataset.tgl);
    let tglCheckout = new Date(opt.dataset.tgl);
    let lama = Math.floor((tglCheckout - tglCheckin) / (1000 * 60 * 60 * 24));

    document.getElementById('lama_tinggal').value = lama;
});

document.getElementById('tgl_checkout').addEventListener('change', function () {

    let tglCheckin = document.getElementById('id_checkin')
        .selectedOptions[0]
        .dataset.tgl; // tanggal check-in dari option

    let checkin = new Date(tglCheckin);
    let checkout = new Date(this.value);

    // Hitung selisih hari
    let selisihHari = Math.floor(
        (checkout - checkin) / (1000 * 60 * 60 * 24)
    );

    // Jika checkout < checkin
    if (selisihHari < 0) {
        document.getElementById('lama_tinggal').value = '';
        alert('Tanggal check out tidak boleh lebih kecil dari check in');
        this.value = '';
        return;
    }

    let hasil = '';
    if (selisihHari < 30) {
        hasil = selisihHari + ' Hari';
    } else {
        let bulan = Math.floor(selisihHari / 30);
        let hari = selisihHari % 30;
        hasil = bulan + ' Bulan ' +  hari + ' Hari ';
    }

    document.getElementById('lama_tinggal').value = hasil;
});

</script>


</main> 
@endsection
