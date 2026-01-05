@extends('layouts.app') <!-- Asumsikan layout utama -->

@section('content')
<style>
    /* Tambahkan CSS untuk mencegah scroll horizontal dan perbaiki spacing */
    body {
        overflow-x: hidden; /* Mencegah scroll horizontal di seluruh halaman */
    }
    .container {
        max-width: 100%; /* Kembali ke 100% agar konten menggunakan lebar penuh */
        padding-left: 700px; /* Tingkatkan padding kiri untuk ruang lebih */
        padding-right: 30px; /* Tingkatkan padding kanan untuk ruang lebih */
    }
    .card-title {
        word-wrap: break-word; /* Pecah kata panjang jika perlu */
        overflow-wrap: break-word;
    }
    .card-text {
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    .row {
        margin-left: 0; /* Pastikan row tidak ada margin kiri tambahan */
        margin-right: 0; /* Pastikan row tidak ada margin kanan tambahan */
    }
</style>

<div class="container mt-4">
    <h1 class="mb-4">Dashboard Kost - {{ ucfirst($kostName) }}</h1>

    <!-- Form Pilih Kost -->
    <form method="GET" action="{{ route('dashboard.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <label for="kost_id" class="form-label">Pilih Kost:</label>
                <select name="kost_id" id="kost_id" class="form-select" onchange="this.form.submit()">
                    @foreach($kosts as $id => $name)
                        <option value="{{ $id }}" {{ $kostId == $id ? 'selected' : '' }}>
                            {{ ucfirst($name) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <!-- Cards untuk Data -->
    <div class="row">
        <!-- Card Kamar Kosong -->
    <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-white bg-success">
                <div class="card-header">
                    <i class="bi bi-house-door"></i> Kamar Kosong
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $kamarKosong }}</h5>
                    <p class="card-text">Jumlah kamar yang tersedia di {{ ucfirst($kostName) }}.</p>
                </div>
            </div>
        </div>

        <!-- Card Kamar Terisi -->
            <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-header">
                    <i class="bi bi-house-check"></i> Kamar Terisi
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $kamarTerisi }}</h5>
                    <p class="card-text">Jumlah kamar yang sudah ditempati di {{ ucfirst($kostName) }}.</p>
                </div>
            </div>
        </div>

        <!-- Card Pemasukan -->
            <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-white bg-info">
                <div class="card-header">
                    <i class="bi bi-cash-stack"></i> Pemasukan
                </div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($pemasukan, 0, ',', '.') }}</h5>
                    <p class="card-text">Total pemasukan dari transaksi di {{ ucfirst($kostName) }}.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection