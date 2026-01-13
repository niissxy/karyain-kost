@extends('layouts.app')
@section('title', 'Laporan Penghuni Kost Regol 2')

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
                        <a href="{{ url('lappenghuni_regol2') }}">Master Data</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Laporan Penghuni Kost Regol 2
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
                            <i class="bi bi-person-check-fill"></i> Total Penghuni Aktif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $totalPenghuniAktif ?? '-' }}</h5>
                            <p class="card-text">
                                Total Penghuni Aktif
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Pemasukan -->
               <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card text-white bg-primary h-100">
                        <div class="card-header">
                            <i class="bi bi-person-plus-fill"></i> Penghuni Baru
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $penghuniBaru ?? '-' }}</h5>
                            <p class="card-text">
                                Total Penghuni Baru
                            </p>
                        </div>
                    </div>
                </div>

                 <!-- Pemasukan -->
               <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-header">
                            <i class="bi bi-person-dash-fill"></i> Penghuni Keluar
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $penghuniKeluar ?? '-' }}</h5>
                            <p class="card-text">
                                Total Penghuni Keluar
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
                    <h5 class="mb-0">Laporan Penghuni Kost Regol 2</h5>
                    <a href="{{ url('lappenghuni_regol2/create') }}"
                       class="btn btn-warning btn-sm">
                        <i class="bi bi-plus-circle"></i> New
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
                                    <th>ID Penghuni</th>
                                    <th>Nama Penghuni</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Keluar</th>
                                    <th>Durasi Sewa</th>
                                    <th>Status</th>
                                    <th>User</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lappenghuni_regol2 as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->id_lappenghuni }}</td>
                                    <td>{{ $item->id_penghuni }}</td>
                                    <td>{{ $item->nama_penghuni }}</td>
                                    <td>{{ $item->tgl_masuk }}</td>
                                    <td>{{ $item->tgl_keluar }}</td>
                                    <td>{{ $item->durasi_sewa }}</td>
                                    <td>{{ $item->status_penghuni }}</td>
                                    <td>{{ $item->user->name ?? '-' }}</td>
                                    <td class="d-flex gap-1">
                                        <!-- <a href="{{ url('laptransaksi_cibiru1/'.$item->id_transaksi.'/edit') }}"
                                           class="btn btn-success btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ url('laptransaksi_cibiru1/'.$item->id_transaksi) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin hapus data?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-success btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form> -->
                                    </td>
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
