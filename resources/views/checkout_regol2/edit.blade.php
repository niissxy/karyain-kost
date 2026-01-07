@extends('layouts.app')
@section('title', 'Data Check Out Kost Regol 2')
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
                            Edit Data Check Out Kost Regol 2
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
                        <h5 class="card-title mb-0">Edit Data Check Out Kost Regol 2</h5>
                        <a class="btn btn-warning btn-sm" href="{{ url('./checkout_regol2') }}">
                            <i class="bi bi-arrow-left-circle-fill"></i> Back
                        </a>
                    </div>

                    <form action="{{ url('checkout_regol2/' . $checkout_regol2->id_checkout) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card-body">

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">ID Check Out</label>
            <div class="col-sm-9">
                <input type="text" class="form-control"
                    value="{{ $checkout_regol2->id_checkout }}"
                    readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Tanggal Check Out</label>
            <div class="col-sm-9">
                <input type="date" id="tgl_checkout" class="form-control"
                    name="tgl_checkout"
                    value="{{ old('tgl_checkout', $checkout_regol2->tgl_checkout) }}"
                    required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-9">
           <input type="hidden" id="tgl_checkin"
                value="{{ $checkout_regol2->checkin->tgl_checkin }}">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nama Penghuni</label>
            <div class="col-sm-9">
                <input type="text" class="form-control"
                    value="{{ $checkout_regol2->nama_penghuni }}"
                    readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Lama Tinggal (hari)</label>
            <div class="col-sm-9">
                <input type="number" id="lama_tinggal" class="form-control"
                    name="lama_tinggal"
                    value="{{ old('lama_tinggal', $checkout_regol2->lama_tinggal) }}"
                    required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">No Kamar</label>
            <div class="col-sm-9">
                <input type="text" class="form-control"
                    value="{{ $checkout_regol2->no_kamar }}"
                    readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-9">
                <select class="form-control" name="status">
                    <option value="Check out" selected>Check Out</option>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tglCheckout = document.querySelector('[name="tgl_checkout"]');
    const tglCheckin  = document.getElementById('tgl_checkin');
    const lamaTinggal = document.getElementById('lama_tinggal');

    tglCheckout.addEventListener('change', function () {
        if (!tglCheckout.value || !tglCheckin.value) return;

        const checkinDate  = new Date(tglCheckin.value);
        const checkoutDate = new Date(tglCheckout.value);

        let diff = Math.floor(
            (checkoutDate - checkinDate) / (1000 * 60 * 60 * 24)
        );

        lamaTinggal.value = diff >= 0 ? diff : 0;
    });
});
</script>


</main> 
@endsection
