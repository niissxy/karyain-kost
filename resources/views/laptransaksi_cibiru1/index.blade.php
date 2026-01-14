@extends('layouts.app')
@section('title', 'Laporan Transaksi Kost Cibiru 1')

@section('content')

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
                        <a href="{{ url('laptransaksi_cibiru1') }}">Master Data</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Laporan Transaksi Kost Cibiru 1
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
                            <i class="bi bi-receipt"></i> Total Transaksi
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $totalTransaksi ?? '-' }}</h5>
                            <p class="card-text">
                                Total Transaksi
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Pemasukan -->
               <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card text-white bg-info h-100">
                        <div class="card-header">
                            <i class="bi bi-cash-stack"></i> Pemasukan
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                Rp {{ isset($pemasukan) ? number_format($pemasukan,0,',','.') : '-' }}
                            </h5>
                            <p class="card-text">
                                Total pemasukan transaksi
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
                    <h5 class="mb-0">Laporan Transaksi Kost Cibiru 1</h5>
                    <a href="{{ url('laptransaksi_cibiru1/create') }}"
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
                                    <th>ID Transaksi</th>
                                    <th>Nama Penghuni</th>
                                    <th>No Kamar</th>
                                    <th>Nominal</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Status</th>
                                    <th>User</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laptransaksi_cibiru1 as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->id_laptransaksi }}</td>
                                    <td>{{ $item->id_transaksi }}</td>
                                    <td>{{ $item->nama_penghuni }}</td>
                                    <td>{{ $item->no_kamar }}</td>
                                    <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                    <td>{{ $item->tgl_pembayaran }}</td>
                                    <td>{{ $item->status_pembayaran }}</td>
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
