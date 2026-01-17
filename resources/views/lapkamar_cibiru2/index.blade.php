@extends('layouts.app')
@section('title', 'Laporan Kamar Kost Cibiru 2')

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
    border-bottom: 0;
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
                        <a href="{{ url('lapkamar_cibiru2') }}">Master Data</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Laporan Kamar Kost Cibiru 2
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
                    <div class="card text-white bg-success bg-gradient h-100 shadow">
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
                    <div class="card text-white bg-primary bg-gradient h-100 shadow">
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
                    <div class="card text-white bg-danger bg-gradient h-100 shadow">
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
                    <h5 class="mb-0">Laporan Kamar Kost Cibiru 2</h5>
                    <a href="{{ url('lapkamar_cibiru2/create') }}"
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
                                    <th class="bg-body-secondary">No</th>
                                    <th class="bg-body-secondary">ID Laporan</th>
                                    <th class="bg-body-secondary">ID Kamar</th>
                                    <th class="bg-body-secondary">No Kamar</th>
                                    <th class="bg-body-secondary">Tipe Kamar</th>
                                    <th class="bg-body-secondary">Harga Harian</th>
                                    <th class="bg-body-secondary">Harga Bulanan</th>
                                    <th class="bg-body-secondary">Status Kamar</th>
                                    <th class="bg-body-secondary">User</th>
                                    <th class="text-center bg-body-secondary">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lapkamar_cibiru2 as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->id_lapkamar }}</td>
                                    <td>{{ $item->id_kamar }}</td>
                                    <td>{{ $item->no_kamar }}</td>
                                    <td>{{ $item->tipe_kamar }}</td>
                                   <td>Rp {{ number_format($item->harga_harian, 0, ',', '.') }}</td>
                                   <td>Rp {{ number_format($item->harga_bulanan, 0, ',', '.') }}</td>
                                    <td>{{ $item->status_kamar }}</td>
                                     <td>{{ $item->user->name ?? '-' }}</td>
                                     <td style="text-align: center; vertical-align: middle;">
                                    <div style="display: inline-flex; justify-content: center; align-items: center; gap: 4px;">
                                     <!-- Tombol Delete -->
                                         @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm bi bi-trash"
                                        onclick="confirmDelete('{{ $item->id_lapkamar }}')"></button>
                                        &nbsp;
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

                        @if (session('success'))
                        <script>
                            Swal.fire({
                                title: 'Success!',
                                text: "{{ session('success') }}",
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        </script>
                         @elseif (session('error'))
                         <script>
                            Swal.fire({
                                title: 'Error',
                                text: "{{ session('error') }}",
                                icon: 'error',
                                confirmButtonText:'OK'
                            });
                         </script>
                        @endif
                        <script>
            function confirmDelete(id_lapkamar) {
                Swal.fire({
                    title: 'Yakin Hapus Data?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = document.createElement('form');
                        form.action = "{{ route('lapkamar_cibiru2.destroy', ':id_lapkamar') }}".replace(':id_lapkamar', id_lapkamar);
                        form.method = 'POST';
                        form.innerHTML = `
                            @csrf
                            @method('DELETE')
                            `;
                        document.body.appendChild(form);
                        form.submit();
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil dihapus',
                            icon: 'success',
                        })
                    }
                })
            }
        </script>
</main>
@endsection
