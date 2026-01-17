<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Karyain Kost</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=Montserrat" rel="stylesheet">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        /* ===== MAIN CONTENT ===== */
        #main-content {
            margin-left: 150px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        /* sidebar collapsed (desktop) */
        body.sidebar-collapsed #main-content {
            margin-left: 70px;
        }

        /* ===== MOBILE ===== */
        @media (max-width: 991.98px) {
            #main-content {
                margin-left: 0;
            }

            #sidebar {
                transform: translateX(-100%);
            }

            body.sidebar-open #sidebar {
                transform: translateX(0);
            }
        }

        /* ===== SIDEBAR ===== */
#sidebar {
    width: 260px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background: #212529;
    transition: transform 0.3s ease;
    z-index: 1000;

    /* === INI KUNCI SCROLL === */
    overflow-y: auto;
    overflow-x: hidden;
}

#sidebar .nav-link {
    font-size: 14px; /* default 16px → diperkecil */
}


/* sidebar hidden (desktop) */
body.sidebar-collapsed #sidebar {
    transform: translateX(-100%);
}

/* ===== MAIN CONTENT ===== */
#main-content {
    margin-left: 150px;
    margin-top: 10px;
    padding: 20px;
    transition: margin-left 0.3s ease;
}

body.sidebar-collapsed #main-content {
    margin-left: 0;
}

/* ===== MOBILE ===== */
@media (max-width: 991.98px) {
    #main-content {
        margin-left: 0;
    }

    #sidebar {
        transform: translateX(-100%);
    }

    body.sidebar-open #sidebar {
        transform: translateX(0);
    }
}

    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    @include('layouts.sidebar')

    {{-- TOPBAR (MOBILE) --}}
    <nav class="navbar navbar-dark bg-dark d-lg-none">
        <div class="container-fluid">
            <button class="btn btn-outline-light" onclick="toggleMobileSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <span class="navbar-brand ms-2">Karyain Kost</span>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <div id="main-content" class="container-fluid">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-collapsed');
        }

        function toggleMobileSidebar() {
            document.body.classList.toggle('sidebar-open');
        }
    </script>

</body>
</html>
