@extends('layouts.app')
@section('title', 'Data Sewa Kost Cibiru 2')

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
    margin-right: 40px;
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
                    <a href="./sewa_cibiru2">Master Data</a>
                </li>
                <li class="breadcrumb-item active">
                    Data Sewa Kost Cibiru 2
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
                <h5 class="card-title">Data Sewa Kost Cibiru 2</h5>
                <a href="{{ url('sewa_cibiru2/create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle"></i> New
                </a>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Sewa</th>
                                <th>Nama Penyewa</th>
                                <th>Durasi Sewa</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Berakhir</th>
                                <th>Jatuh Tempo</th>
                                <th>Perpanjangan</th>
                                <th>User ID</th>
                                <th>Ubah</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sewa_cibiru2 as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id_sewa }}</td>
                                <td>{{ $item->nama_penyewa }}</td>
                                <td>{{ $item->durasi_sewa }}</td>
                                <td>{{ $item->tgl_mulai }}</td>
                                <td>{{ $item->tgl_berakhir }}</td>
                                <td>{{ $item->jatuh_tempo }}</td>
                                <td>{{ $item->perpanjangan }}</td>
                                <td>{{ $item->user_id }}</td>
                                <td>
                                    <a href="{{ url('sewa_cibiru2/'.$item->id_sewa.'/edit') }}"
                                       class="btn btn-success btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ url('sewa_cibiru2/'.$item->id_sewa) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin hapus data?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-success btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
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
