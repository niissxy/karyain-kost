@extends('layouts.app')

@section('content')
<style>
    body {
        overflow-x: hidden;
    }
    .container {
        max-width: 100%;
        padding-left: 30px;
        padding-right: 30px;
    }
    .card-title, .card-text {
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    .row {
        margin-left: 0;
        margin-right: 0;
    }
</style>

<div class="container mt-4">
    <h1 class="mb-4">Dashboard {{ $kostDisplayName }}</h1>

    <!-- Form Pilih Kost -->
    <form method="GET" action="{{ route('dashboard.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <label for="kost_id" class="form-label">Pilih Kost:</label>
               <select name="kost_id" id="kost_id" class="form-select" onchange="this.form.submit()">
                    @foreach($kosts as $id => $name)
                    <option value="{{ $id }}" {{ $kostId == $id ? 'selected' : '' }}>
                         {{ $kostDisplayNames[$id] ?? ucfirst($name) }}
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
                    <p class="card-text">Jumlah kamar yang tersedia di {{ $kostDisplayName }}.</p>
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
                    <p class="card-text">Jumlah kamar yang sudah ditempati di {{ $kostDisplayName }}.</p>
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
                    <p class="card-text">Total pemasukan dari transaksi di {{ $kostDisplayName }}.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
