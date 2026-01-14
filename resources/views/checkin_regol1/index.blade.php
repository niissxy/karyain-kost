@extends('layouts.app')
@section('title', 'Data Check In Kost Regol 1')

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
    max-width: 1250px;
    margin-right: 27px;
}

/* TABLE CENTER */
.table-responsive {
    display: flex;
    justify-content: center;
}

table {
    width: 100%;
    max-width: 5000px;
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
                    <a href="./checkin_regol1">Master Data</a>
                </li>
                <li class="breadcrumb-item active">
                    Data Check In Kost Regol 1
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
                <h5 class="card-title">Data Check In Kost Regol 1</h5>
                <a href="{{ url('checkin_regol1/create') }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-plus-circle"></i> New Data
                </a>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Check In</th>
                                <th>Tanggal Check In</th>
                                <th>Nama Penghuni</th>
                                <th>No Kamar</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>User</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($checkin_regol1 as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id_checkin }}</td>
                                <td>{{ $item->tgl_checkin }}</td>
                                <td>{{ $item->nama_penghuni }}</td>
                                <td>{{ $item->no_kamar }}</td>
                                 <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td>{{ $item->status }}</td>
                                 <td>{{ $item->user->name ?? '-' }}</td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <div style="display: inline-flex; justify-content: center; align-items: center; gap: 4px;">
                                    <!-- Tombol Edit -->
                                        <a href="{{ url('checkin_regol1/' . $item->id_checkin . '/edit') }}" 
                                         class="btn btn-outline-success btn-sm">
                                         <i class="bi bi-pencil-square"></i>
                                        </a>
                                         &nbsp;
                                         <a href="{{ route('checkin_regol1.exportPdf', $item->id_checkin) }}" 
                                         class="btn btn-outline-primary btn-sm">
                                         <i class="bi bi-file-earmark-pdf-fill"></i>
                                        </a>
                                         &nbsp;
                                     <!-- Tombol Delete -->
                                        <form action="{{ url('checkin_regol1/' . $item->id_checkin) }}" method="POST" 
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
