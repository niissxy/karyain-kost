@extends('layouts.app')
@section('title', 'Laporan Kamar Kost Regol 2')

@section('content')
@php
    use Carbon\Carbon;
@endphp


<style>
/* ===== GLOBAL ===== */
body {
    background-color: #f5f6f8;
    overflow-x: hidden;
}

/* ===== MAIN ===== */
.main {
    padding: 20px 24px;
}

/* ===== WRAPPER TENGAH (SATU-SATUNYA) ===== */
.center-wrapper {
    max-width: 1250px;
    margin: 0 auto;
}

/* ===== PAGE TITLE ===== */
.pagetitle-wrapper {
    display: flex;
    justify-content: center;
    margin-bottom: 16px;
}

.pagetitle {
    width: 100%;
    max-width: 1250px;
}

/* ===== CARD RINGKASAN ===== */
.summary-card .card {
    border-radius: 10px;
}

.summary-card .card-header {
    padding: 8px 12px;
    font-size: 14px;
}

.summary-card .card-body {
    padding: 12px;
}

.summary-card .card-title {
    font-size: 20px;
    font-weight: 600;
}

.summary-card .card-text {
    font-size: 12px;
}

/* ===== CARD TABEL ===== */
.table-card {
    width: 100%;
    max-width: 1250px;
    margin: 0 auto; /* 🔑 KUNCI TENGAH */
}

/* ===== TABLE RESET ===== */
.table {
    width: 100%;
    margin: 0 auto;
}

.table th,
.table td {
    font-size: 14px;
    vertical-align: middle;
}



</style>

<main id="main" class="main">

    <!-- ===== BREADCRUMB ===== -->
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('lapkamar_regol2') }}">Master Data</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Laporan Kamar Kost Regol 2
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- ===== CARD RINGKASAN ===== -->
    <section class="mb-4">
        <div class="center-wrapper">
            <div class="row justify-content-center summary-card">

                <!-- Kamar Kosong -->
                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card text-white bg-success h-100">
                        <div class="card-header">
                            <i class="bi bi-house-check"></i> Jumlah Kamar Terisi
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $jumlahKamarTerisi ?? '-' }}</h5>
                            <p class="card-text">
                                Kamar Terisi
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Pemasukan -->
               <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card text-white bg-primary h-100">
                        <div class="card-header">
                            <i class="bi bi-house-door"></i> Jumlah Kamar Kosong
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $jumlahKamarKosong ?? '-' }}</h5>
                            <p class="card-text">
                                Kamar Kosong
                            </p>
                        </div>
                    </div>
                </div>

                 <!-- Pemasukan -->
               <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-header">
                            <i class="bi bi-calendar-check"></i> Jumlah Kamar Dibooking
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $jumlahKamarDibooking ?? '-' }}</h5>
                            <p class="card-text">
                                Kamar Dibooking
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ===== TABEL ===== -->
    <section>
        <div class="center-wrapper" style="margin-right: 125px;">
            <div class="card table-card">

                <!-- HEADER -->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Laporan Kamar Kost Regol 2</h5>
                    <a href="{{ url('lapkamar_regol2/create') }}"
                       class="btn btn-warning btn-sm">
                        <i class="bi bi-plus-circle"></i> New Data
                    </a>
                </div>

                <!-- BODY -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Laporan</th>
                                    <th>ID Kamar</th>
                                    <th>No Kamar</th>
                                    <th>Tipe Kamar</th>
                                    <th>Harga</th>
                                    <th>Status Kamar</th>
                                    <th>User</th>
                                    <th>Fungsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lapkamar_regol2 as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->id_lapkamar }}</td>
                                    <td>{{ $item->id_kamar }}</td>
                                    <td>{{ $item->no_kamar }}</td>
                                    <td>{{ $item->tipe_kamar }}</td>
                                   <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>{{ $item->status_kamar }}</td>
                                     <td>{{ $item->user->name ?? '-' }}</td>
                                     <td style="text-align: center; vertical-align: middle;">
                                    <div style="display: inline-flex; justify-content: center; align-items: center; gap: 4px;">
                                     <!-- Tombol Delete -->
                                        <form action="{{ url('lapkamar_regol2/' . $item->id_lapkamar) }}" method="POST" 
                                            onsubmit="return confirm('Yakin hapus data?')" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                    <!-- <td class="d-flex gap-1">
                                    </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
@endsection
