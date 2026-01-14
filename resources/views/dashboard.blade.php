@extends('layouts.app')

@section('content')

<style>
/* ===== GLOBAL ===== */
body {
    overflow-x: hidden;
}

/* ===== CONTAINER ===== */
.container {
    max-width: 100%;
    padding-left: 30px;
    padding-right: 30px;
}

/* ===== DASHBOARD CARD ===== */
.dashboard-card {
    border-radius: 14px;
    min-height: 150px;
}

.dashboard-card .card-header {
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;

    border-bottom: 0;
}

.dashboard-card .card-body {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.dashboard-card .card-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 4px;
}

.dashboard-card .card-text {
    font-size: 0.85rem;
    opacity: 0.9;
}

/* ===== ROW FIX ===== */
.row {
    margin-left: 0;
    margin-right: 0;
}
</style>

<div class="container mt-4">

    <h1 class="mb-4">Dashboard {{ $kostDisplayName }}</h1>

    <!-- ================= PILIH KOST ================= -->
    <form method="GET" action="{{ route('dashboard.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <label for="kost_id" class="form-label fw-semibold">Pilih Kost</label>
                <select name="kost_id"
                        id="kost_id"
                        class="form-select"
                        onchange="this.form.submit()">
                    @foreach($kosts as $id => $name)
                        <option value="{{ $id }}" {{ $kostId == $id ? 'selected' : '' }}>
                            {{ $kostDisplayNames[$id] ?? ucfirst($name) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <!-- ================= DASHBOARD CARDS ================= -->
    <div class="row g-3">

        <!-- KAMAR KOSONG -->
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-white bg-success-bg-gradient dashboard-card shadow-sm border-0">
                <div class="card-header">
                    <i class="bi bi-house-door"></i>
                    Kamar Kosong
                </div>
                <div class="card-body">
                    <div class="card-title">{{ $kamarKosong }}</div>
                    <div class="card-text">
                        Kamar tersedia di {{ $kostDisplayName }}
                    </div>
                </div>
            </div>
        </div>

        <!-- KAMAR TERISI -->
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-white bg-warning dashboard-card shadow-sm boder-0">
                <div class="card-header">
                    <i class="bi bi-house-check"></i>
                    Kamar Terisi
                </div>
                <div class="card-body">
                    <div class="card-title">{{ $kamarTerisi }}</div>
                    <div class="card-text">
                        Kamar sedang ditempati
                    </div>
                </div>
            </div>
        </div>

        <!-- PEMASUKAN -->
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-white bg-info dashboard-card shadow-sm border-0">
                <div class="card-header">
                    <i class="bi bi-cash-stack"></i>
                    Pemasukan
                </div>
                <div class="card-body">
                    <div class="card-title">
                        Rp {{ number_format($pemasukan, 0, ',', '.') }}
                    </div>
                    <div class="card-text">
                        Total Pemasukan {{ $kostDisplayName }}
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
