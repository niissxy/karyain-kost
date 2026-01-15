@extends('layouts.app')
@section('title', 'Data Kamar Kost Cibiru 2')

@section('content')

<style>
    /* ===== GLOBAL ===== */
    body {
        background-color: #f5f6f8;
        overflow-x: hidden;
    }

    /* ===== MAIN CONTENT (GESER DARI SIDEBAR) ===== */
   /* MAIN */
.main {
    padding: 20px 24px;
}

/* SECTION CENTER */
.section.dashboard {
    display: flex;
    justify-content: center;
}

/* CARD CENTER */
.section.dashboard .card {
    width: 100%;
    max-width: 1100px;
}

/* TABLE CENTER */
.table-responsive {
    display: flex;
    justify-content: center;
}

table {
    width: 100%;
    max-width: 2000px;
    table-layout: fixed;
}

.pagetitle-wrapper {
    display: flex;
    justify-content: center;
    margin-bottom: 16px;
}

.pagetitle {
    width: 100%;
    max-width: 1100px;
}


</style>

<main id="main" class="main">

 <div class="pagetitle-wrapper">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="./kamar_cibiru2">Master Data</a>
                </li>
                <li class="breadcrumb-item active">
                    Data Kamar Kost Cibiru 2
                </li>
            </ol>
        </nav>
    </div>
</div>

    <!-- Content -->
    <section class="section dashboard">
        <div class="card">

            <!-- Card Header -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Data Kamar Kost Cibiru 2</h5>
                <a href="{{ url('kamar_cibiru2/create') }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-plus-circle"></i> New Data
                </a>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th class="bg-body-secondary">No</th>
                                <th class="bg-body-secondary">ID Kamar</th>
                                <th class="bg-body-secondary">Tipe Kamar</th>
                                <th class="bg-body-secondary">No Kamar</th>
                                <th class="bg-body-secondary">Status</th>
                                <th class="bg-body-secondary">Harga Harian</th>
                                <th class="bg-body-secondary">Harga Bulanan</th>
                                <th class="bg-body-secondary">User</th>
                                <th class="text-center bg-body-secondary">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kamar_cibiru2 as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id_kamar }}</td>
                                <td>{{ $item->tipe_kamar }}</td>
                                <td>{{ $item->no_kamar }}</td>
                                <td>{{ $item->status_kamar }}</td>
                                <td>Rp {{ number_format($item->harga_harian, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($item->harga_bulanan, 0, ',', '.') }}</td>
                                 <td>{{ $item->user->name ?? '-' }}</td>
                                 <td style="text-align: center; vertical-align: middle;">
                                    <div style="display: inline-flex; justify-content: center; align-items: center; gap: 4px;">
                                    <!-- Tombol Edit -->
                                        <a href="{{ url('kamar_cibiru2/' . $item->id_kamar . '/edit') }}" 
                                         class="btn btn-outline-success btn-sm">
                                         <i class="bi bi-pencil-square"></i>
                                        </a>
                                         &nbsp;
                                     <!-- Tombol Delete -->
                                        <form action="{{ url('kamar_cibiru2/' . $item->id_kamar) }}" method="POST" 
                                            onsubmit="return confirm('Yakin hapus data?')" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>

</main>
@endsection
