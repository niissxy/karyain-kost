@extends('layouts.app')
@section('title', 'Data Transaksi Kost Cibiru 1')
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
                            Edit Data Transaksi Kost Cibiru 1
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
                        <h5 class="card-title mb-0">Edit Data Transaksi Kost Cibiru 1</h5>
                        <a class="btn btn-warning btn-sm" href="{{ url('./transaksi_cibiru1') }}">
                            <i class="bi bi-arrow-left-circle-fill"></i> Back
                        </a>
                    </div>

                    <form action="{{ url('transaksi_cibiru1/' .$transaksi_cibiru1->id_transaksi) }}" method="post"  enctype="multipart/form-data">
                        @method('put')
                        {{ csrf_field() }}

                        <div class="card-body">

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">ID Transaksi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  readonly  value="{{ old('id_transaksi',$transaksi_cibiru1->id_transaksi) }}"  name="id_transaksi"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Penyewa</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ old('nama_penyewa',$transaksi_cibiru1->nama_penyewa) }}"  name="nama_penyewa"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Total Penyewa</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" value="{{ old('total_penyewa',$transaksi_cibiru1->total_penyewa) }}"  name="total_penyewa"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">No Kamar</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ old('no_kamar',$transaksi_cibiru1->no_kamar) }}"  name="no_kamar"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Total Harga</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" value="{{ old('total_harga',$transaksi_cibiru1->total_harga) }}"  name="total_harga"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Total Bayar</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" value="{{ old('total_bayar',$transaksi_cibiru1->total_bayar) }}"  name="total_bayar"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Pembayaran</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" value="{{ old('tgl_pembayaran',$transaksi_cibiru1->tgl_pembayaran) }}"  name="tgl_pembayaran"  required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="status" name="status">
                                        <option value='Lunas' {{ old('status', $transaksi_cibiru1->status) == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                        <option value='Belum lunas' {{ old('status', $transaksi_cibiru1->status) == 'Belum lunas' ? 'selected' : '' }}>Belum lunas</option>
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
