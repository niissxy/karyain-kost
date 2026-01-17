@extends('layouts.app')
@section('title', 'Data Fasilitas Kamar Kost Cibiru 2')

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
                    <a href="./faskamar_cibiru2">Master Data</a>
                </li>
                <li class="breadcrumb-item active">
                    Data Fasilitas Kamar Kost Cibiru 2
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
                <h5 class="card-title">Data Fasilitas Kamar Kost Cibiru 2</h5>
                <a href="{{ url('faskamar_cibiru2/create') }}" class="btn btn-warning btn-sm">
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
                                <th class="bg-body-secondary">ID Fasilitas Kamar</th>
                                <th class="bg-body-secondary">Nama Fasilitas</th>
                                <th class="bg-body-secondary">No Kamar</th>
                                <th class="bg-body-secondary">Kondisi</th>
                                <th class="bg-body-secondary">User</th>
                               <th class="text-center bg-body-secondary">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faskamar_cibiru2 as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id_fask }}</td>
                                <td>{{ $item->nama_fasilitas }}</td>
                                <td>{{ $item->no_kamar }}</td>
                                <td>{{ $item->kondisi }}</td>
                                 <td>{{ $item->user->name ?? '-' }}</td>
                               <td style="text-align: center; vertical-align: middle;">
                                    <div style="display: inline-flex; justify-content: center; align-items: center; gap: 4px;">
                                    <!-- Tombol Edit -->
                                        <a href="{{ url('faskamar_cibiru2/' . $item->id_fask . '/edit') }}" 
                                         class="btn btn-outline-success btn-sm">
                                         <i class="bi bi-pencil-square"></i>
                                        </a>
                                         &nbsp;
                                     <!-- Tombol Delete -->
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger bi bi-trash"
                                        onclick="confirmDelete('{{ $item->id_fask }}')"></button>
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
            function confirmDelete(id_fask) {
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
                        form.action = "{{ route('faskamar_cibiru2.destroy', ':id_fask') }}".replace(':id_fask', id_fask);
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
