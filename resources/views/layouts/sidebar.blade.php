<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyain Kost</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden;
        }

        /* SIDEBAR */
        #sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            font-size: 13px;
        }

        #sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.08);
        }

        /* COLLAPSE DESKTOP */
        #sidebar.collapsed {
            width: 80px;
        }

        #sidebar.collapsed h5,
        #sidebar.collapsed span,
        #sidebar.collapsed .bi-chevron-down {
            display: none;
        }

        #sidebar.collapsed .nav-link {
            text-align: center;
        }

        /* CONTENT */
        #content {
            margin-left: 260px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        #content.expanded {
            margin-left: 80px;
        }

        /* MOBILE */
        @media (max-width: 768px) {
            #sidebar {
                left: -260px;
            }

            #sidebar.show {
                left: 0;
            }

            #content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<nav id="sidebar" class="bg-dark text-white">
    <div class="p-3">

        <h5 class="text-center mb-4">Karyain Kost</h5>

        <ul class="nav flex-column gap-1">

            <li class="nav-item">
                <a href="/dashboard" class="nav-link text-white">
                    <i class="bi bi-speedometer2"></i>
                    <span class="ms-2">Dashboard</span>
                </a>
            </li>

            <!-- MANAGEMENT KAMAR -->
            <li class="nav-item">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse" href="#submenu-kamar">
                    <span>
                        <i class="bi bi-house"></i>
                        <span class="ms-2">Management Kamar</span>
                    </span>
                    <i class="bi bi-chevron-down"></i>
                </a>

                <div class="collapse ps-4" id="submenu-kamar">
                    <a href="/kamar_cibiru1" class="nav-link text-white">Kamar Cibiru 1</a>
                    <a href="/kamar_cibiru2" class="nav-link text-white">Kamar Cibiru 2</a>
                    <a href="/kamar_regol1" class="nav-link text-white">Kamar Regol 1</a>
                    <a href="/kamar_regol2" class="nav-link text-white">Kamar Regol 2</a>
                </div>
            </li>

            <!-- MANAGEMENT PENGHUNI -->
            <li class="nav-item">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse" href="#submenu-penghuni">
                    <span>
                        <i class="bi bi-people"></i>
                        <span class="ms-2">Management Penghuni</span>
                    </span>
                    <i class="bi bi-chevron-down"></i>
                </a>

                <div class="collapse ps-4" id="submenu-penghuni">
                    <a href="/penghuni_cibiru1" class="nav-link text-white">Penghuni Cibiru 1</a>
                    <a href="/penghuni_cibiru2" class="nav-link text-white">Penghuni Cibiru 2</a>
                    <a href="/penghuni_regol1" class="nav-link text-white">Penghuni Regol 1</a>
                    <a href="/penghuni_regol2" class="nav-link text-white">Penghuni Regol 2</a>
                </div>
            </li>

            <li class="nav-item mt-3">
                <a href="#" class="nav-link text-danger"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                    <span class="ms-2">Logout</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

        </ul>
    </div>
</nav>

<!-- CONTENT -->
<div id="content">

    <!-- TOGGLE BUTTON -->
    <button class="btn btn-dark mb-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
    </button>

    @yield('content')

</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('toggleSidebar').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    if (window.innerWidth <= 768) {
        sidebar.classList.toggle('show'); // MOBILE
    } else {
        sidebar.classList.toggle('collapsed'); // DESKTOP
        content.classList.toggle('expanded');
    }
});
</script>

</body>
</html>
