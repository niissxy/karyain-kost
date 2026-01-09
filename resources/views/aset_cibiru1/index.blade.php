@extends('layouts.app')
@section('title', 'Data Aset Kost Cibiru 1')

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
    /* display: flex; */
    /* justify-content: center; */
    overflow-x: auto; /* cukup ini untuk scroll horizontal */
}


table {
    width: 100%;
    max-width: 5000px;
    table-layout: auto;
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
                    <a href="./aset_cibiru1">Master Data</a>
                </li>
                <li class="breadcrumb-item active">
                    Data Aset Kost Cibiru 1
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
                <h5 class="card-title">Data Aset Kost Cibiru 1</h5>
                <a href="{{ url('aset_cibiru1/create') }}" class="btn btn-success btn-sm">
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
                                <th>ID Aset</th>
                                <th>Nama Aset</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Kondisi</th>
                                <th>User</th>
                                <th class="text-center">Fungsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aset_cibiru1 as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id_aset }}</td>
                                <td>{{ $item->nama_aset }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ $item->kondisi }}</td>
                                 <td>{{ $item->user->name ?? '-' }}</td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <div style="display: inline-flex; justify-content: center; align-items: center; gap: 4px;">
                                    <!-- Tombol Edit -->
                                        <a href="{{ url('aset_cibiru1/' . $item->id_aset . '/edit') }}" 
                                         class="btn btn-outline-success btn-sm">
                                         <i class="bi bi-pencil-square"></i>
                                        </a>
                                         &nbsp;&nbsp;

                                     <!-- Tombol Delete -->
                                        <form action="{{ url('aset_cibiru1/' . $item->id_aset) }}" method="POST" 
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
