@extends('layouts.app')
@section('title', 'Laporan Transaksi Kost Regol 2')

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
                        <a href="{{ url('laptransaksi_regol2') }}">Master Data</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Laporan Transaksi Kost Regol 2
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
                    <div class="card text-white bg-info bg-gradient h-100 shadow">
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
                    <h5 class="mb-0">Laporan Transaksi Kost Regol 2</h5>
                    <a href="{{ url('laptransaksi_regol2/create') }}"
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
                                    <th class="bg-body-secondary">ID Transaksi</th>
                                    <th class="bg-body-secondary">Nama Penghuni</th>
                                    <th class="bg-body-secondary">No Kamar</th>
                                    <th class="bg-body-secondary">Nominal</th>
                                    <th class="bg-body-secondary">Metode Pembayaran</th>
                                    <th class="bg-body-secondary">Tanggal Pembayaran</th>
                                    <th class="bg-body-secondary">Status</th>
                                    <th class="bg-body-secondary">User</th>
                                    <th class="text-center bg-body-secondary">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laptransaksi_regol2 as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->id_laptransaksi }}</td>
                                    <td>{{ $item->id_transaksi }}</td>
                                    <td>{{ $item->nama_penghuni }}</td>
                                    <td>{{ $item->no_kamar }}</td>
                                     <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                     <td>{{ $item->metode_pembayaran }}</td>
                                     <td>{{ $item->tgl_pembayaran }}</td>
                                    <td>{{ $item->status_pembayaran }}</td>
                                     <td>{{ $item->user->name ?? '-' }}</td>
                                     <td style="text-align: center; vertical-align: middle;">
                                    <div style="display: inline-flex; justify-content: center; align-items: center; gap: 4px;">
                                     <!-- Tombol Delete -->
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm bi bi-trash"
                                        onclick="confirmDelete('{{ $item->id_laptransaksi }}')"></button>
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
            function confirmDelete(id_laptransaksi) {
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
                        form.action = "{{ route('laptransaksi_regol2.destroy', ':id_laptransaksi') }}".replace(':id_laptransaksi', id_laptransaksi);
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
