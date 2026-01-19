@extends('layouts.app')
@section('title', 'Data Transaksi Kost Cibiru 1')
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
                            Tambah Data Transaksi Kost Cibiru 1
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
                        <h5 class="card-title mb-0">Tambah Data Transaksi Kost Cibiru 1</h5>
                        <a class="btn btn-warning btn-sm" href="{{ url('./transaksi_cibiru1') }}">
                            <i class="bi bi-arrow-left-circle-fill"></i> Back
                        </a>
                    </div>

                    <form action="{{ url('transaksi_cibiru1') }}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}

                        <div class="card-body">

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">ID Transaksi</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="id_transaksi" required value="{{ $newKode }}" readonly>
                                </div>
                            </div>

                           <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Penyewa</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="nama_penyewa" type="text" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Metode Pembayaran</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="metode_pembayaran">
                                        <option value="">-- Pilih Metode Pembayaran --</option>
                                        <option value="BCA">BCA</option>
                                        <option value="BRI">BRI</option>
                                        <option value="BNI">BNI</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="BTPN/JENIUS">BTPN/JENIUS</option>
                                        <option value="BSI">BSI</option>
                                        <option value="Bank Jago">Bank Jago</option>
                                        <option value="SeaBank">SeaBank</option>
                                        <option value="DANA">DANA</option>
                                        <option value="OVO">OVO</option>
                                        <option value="LinkAja">LinkAja</option>
                                        <option value="SHOPEE PAY">SHOPEE PAY</option>
                                        <option value="GoPay">GoPay</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Total Penyewa</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="total_penyewa" type="text" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Durasi Sewa</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="durasi_sewa" type="text" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">No Kamar</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="no_kamar" type="text" required>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nominal</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="nominal" type="number" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Pembayaran</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="tgl_pembayaran" type="date" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="status">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Lunas">Lunas</option>
                                        <option value="Belum lunas">Belum lunas</option>
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
