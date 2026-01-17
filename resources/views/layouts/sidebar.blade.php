<style>
/* ===== SIDEBAR BASE ===== */
#sidebar {
    font-size: 13px;
    width: 260px;
    transition: width 0.3s ease;
    overflow-x: hidden;
}

#sidebar.collapsed {
    width: 70px;
}

/* hide text when collapsed */
#sidebar.collapsed .nav-link span,
#sidebar.collapsed h5 {
    display: none;
}

#sidebar.collapsed .nav-link {
    justify-content: center;
}

#sidebar.collapsed .bi-chevron-down {
    display: none;
}

/* submenu spacing */
#sidebar .collapse {
    margin-top: 4px;
}

#sidebar .collapse .nav-link {
    font-size: 13px;
    opacity: 0.9;
}

/* hover */
#sidebar .nav-link:hover {
    background-color: rgba(255,255,255,0.08);
}

/* toggle button */
.sidebar-toggle {
    position: absolute;
    top: 12px;
    right: -40px;
    background: #212529;
    color: #fff;
    border-radius: 4px;
    padding: 6px 10px;
    cursor: pointer;
}
</style>


<!-- Sidebar -->
<nav id="sidebar" class="bg-dark text-white vh-100 position-fixed"
     style="width: 260px; left: 0; top: 0; z-index: 1000;">

     <div class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </div>

    <div class="p-3">
        <h5 class="text-center mb-4">Karyain Kost</h5>

        <ul class="nav flex-column gap-1">

         <li class="nav-item">
                <a href="/dashboard" class="nav-link text-white">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse" href="#submenu-kamar">
                    <span><i class="bi bi-house me-2"></i> Management Kamar </span>
                    <i class="bi bi-chevron-down"></i>
                </a>

                <div class="collapse ps-3" id="submenu-kamar">
                    <a href="/kamar_cibiru1" class="nav-link text-white small">
                        <i class="bi bi-house me-2"></i> Kamar Kost Cibiru 1
                    </a>
                   <a href="/kamar_cibiru2" class="nav-link text-white small">
                        <i class="bi bi-house me-2"></i> Kamar Kost Cibiru 2
                    </a>
                   <a href="/kamar_regol1" class="nav-link text-white small">
                        <i class="bi bi-house me-2"></i> Kamar Kost Regol 1
                    </a>
                    <a href="/kamar_regol2" class="nav-link text-white small">
                        <i class="bi bi-house me-2"></i> Kamar Kost Regol 2
                    </a>
                </div>
            </li>
            

           <li class="nav-item">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse" href="#submenu-penghuni">
                    <span><i class="bi bi-people me-2"></i> Management Penghuni </span>
                    <i class="bi bi-chevron-down"></i>
                </a>

                <div class="collapse ps-3" id="submenu-penghuni">
                    <a href="/penghuni_cibiru1" class="nav-link text-white small">
                        <i class="bi bi-people me-2"></i> Penghuni Kost Cibiru 1
                    </a>
                   <a href="/penghuni_cibiru2" class="nav-link text-white small">
                        <i class="bi bi-people me-2"></i> Penghuni Kost Cibiru 2
                    </a>
                   <a href="/penghuni_regol1" class="nav-link text-white small">
                        <i class="bi bi-people me-2"></i> Penghuni Kost Regol 1
                    </a>
                    <a href="/penghuni_regol2" class="nav-link text-white small">
                        <i class="bi bi-people me-2"></i> Penghuni Kost Regol 2
                    </a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse" href="#submenu-transaksi">
                    <span><i class="bi bi-cash-stack me-2"></i> Transaksi </span>
                    <i class="bi bi-chevron-down"></i>
                </a>

                <div class="collapse ps-3" id="submenu-transaksi">
                    <a href="/transaksi_cibiru1" class="nav-link text-white small">
                        <i class="bi bi-cash-stack me-2"></i> Transaksi Kost Cibiru 1
                    </a>
                   <a href="/transaksi_cibiru2" class="nav-link text-white small">
                        <i class="bi bi-cash-stack me-2"></i> Transaksi Kost Cibiru 2
                    </a>
                   <a href="/transaksi_regol1" class="nav-link text-white small">
                        <i class="bi bi-cash-stack me-2"></i> Transaksi Kost Regol 1
                    </a>
                    <a href="/transaksi_regol2" class="nav-link text-white small">
                        <i class="bi bi-cash-stack me-2"></i> Transaksi Kost Regol 2
                    </a>
                </div>
            </li>

            <!-- Laporan -->
            <li class="nav-item">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse" href="#submenu-laptransaksi">
                    <span><i class="bi bi-receipt me-2"></i> Laporan Transaksi </span>
                    <i class="bi bi-chevron-down"></i>
                </a>

                <div class="collapse ps-3" id="submenu-laptransaksi">
                    <a href="/laptransaksi_cibiru1" class="nav-link text-white small">
                        <i class="bi bi-receipt me-2"></i> Laporan Transaksi Cibiru 1
                    </a>
                   <a href="/laptransaksi_cibiru2" class="nav-link text-white small">
                        <i class="bi bi-receipt me-2"></i> Laporan Transaksi Cibiru 2
                    </a>
                   <a href="/laptransaksi_regol1" class="nav-link text-white small">
                        <i class="bi bi-receipt me-2"></i> Laporan Transaksi Regol 1
                    </a>
                    <a href="/laptransaksi_regol2" class="nav-link text-white small">
                        <i class="bi bi-receipt me-2"></i> Laporan Transaksi Regol 2
                    </a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse" href="#submenu-lapkamar">
                    <span><i class="bi bi-house-door me-2"></i> Laporan Kamar </span>
                    <i class="bi bi-chevron-down"></i>
                </a>

                <div class="collapse ps-3" id="submenu-lapkamar">
                    <a href="/lapkamar_cibiru1" class="nav-link text-white small">
                        <i class="bi bi-house-door me-2"></i> Laporan Kamar Cibiru 1
                    </a>
                   <a href="/lapkamar_cibiru2" class="nav-link text-white small">
                        <i class="bi bi-house-door me-2"></i> Laporan Kamar Cibiru 2
                    </a>
                   <a href="/lapkamar_regol1" class="nav-link text-white small">
                        <i class="bi bi-house-door me-2"></i> Laporan Kamar Regol 1
                    </a>
                    <a href="/lapkamar_regol2" class="nav-link text-white small">
                        <i class="bi bi-house-door me-2"></i> Laporan Kamar Regol 2
                    </a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse" href="#submenu-lappenghuni">
                    <span><i class="bi bi-people-fill me-2"></i> Laporan Penghuni </span>
                    <i class="bi bi-chevron-down"></i>
                </a>

                <div class="collapse ps-3" id="submenu-lappenghuni">
                    <a href="/lappenghuni_cibiru1" class="nav-link text-white small">
                        <i class="bi bi-people-fill me-2"></i> Laporan Penghuni Cibiru 1
                    </a>
                   <a href="/lappenghuni_cibiru2" class="nav-link text-white small">
                        <i class="bi bi-people-fill me-2"></i> Laporan Penghuni Cibiru 2
                    </a>
                   <a href="/lappenghuni_regol1" class="nav-link text-white small">
                        <i class="bi bi-people-fill me-2"></i> Laporan Penghuni Regol 1
                    </a>
                    <a href="/lappenghuni_regol2" class="nav-link text-white small">
                        <i class="bi bi-people-fill me-2"></i> Laporan Penghuni Regol 2
                    </a>
                </div>
            </li>

            <!-- Fasilitas & Aset -->
              <li class="nav-item">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse" href="#submenu-aset">
                    <span><i class="bi bi-box me-2"></i> Aset </span>
                    <i class="bi bi-chevron-down"></i>
                </a>

                <div class="collapse ps-3" id="submenu-aset">
                    <a href="/aset_cibiru1" class="nav-link text-white small">
                        <i class="bi bi-box me-2"></i> Aset Kost Cibiru 1
                    </a>
                   <a href="/aset_cibiru2" class="nav-link text-white small">
                        <i class="bi bi-box me-2"></i> Aset Kost Cibiru 2
                    </a>
                   <a href="/aset_regol1" class="nav-link text-white small">
                        <i class="bi bi-box me-2"></i> Aset Kost Regol 1
                    </a>
                    <a href="/aset_regol2" class="nav-link text-white small">
                        <i class="bi bi-box me-2"></i> Aset Kost Regol 2
                    </a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse" href="#submenu-faskamar">
                    <span><i class="bi bi-door-open me-2"></i> Fasilitas Kamar </span>
                    <i class="bi bi-chevron-down"></i>
                </a>

                <div class="collapse ps-3" id="submenu-faskamar">
                    <a href="/faskamar_cibiru1" class="nav-link text-white small">
                        <i class="bi bi-door-open me-2"></i> Fasilitas Kamar Kost Cibiru 1
                    </a>
                   <a href="/faskamar_cibiru2" class="nav-link text-white small">
                        <i class="bi bi-door-open me-2"></i> Fasilitas Kamar Kost Cibiru 2
                    </a>
                   <a href="/faskamar_regol1" class="nav-link text-white small">
                        <i class="bi bi-door-open me-2"></i> Fasilitas Kamar Kost Regol 1
                    </a>
                    <a href="/faskamar_regol2" class="nav-link text-white small">
                        <i class="bi bi-door-open me-2"></i> Fasilitas Kamar Kost Regol 2
                    </a>
                </div>
            </li>

             <li class="nav-item">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse" href="#submenu-fasum">
                    <span><i class="bi bi-houses me-2"></i> Fasilitas Umum </span>
                    <i class="bi bi-chevron-down"></i>
                </a>

                <div class="collapse ps-3" id="submenu-fasum">
                    <a href="/fasum_cibiru1" class="nav-link text-white small">
                        <i class="bi bi-houses me-2"></i> Fasilitas Umum Kost Cibiru 1
                    </a>
                   <a href="/fasum_cibiru2" class="nav-link text-white small">
                        <i class="bi bi-houses me-2"></i> Fasilitas Umum Kost Cibiru 2
                    </a>
                   <a href="/fasum_regol1" class="nav-link text-white small">
                        <i class="bi bi-houses me-2"></i> Fasilitas Umum Kost Regol 1
                    </a>
                    <a href="/fasum_regol2" class="nav-link text-white small">
                        <i class="bi bi-houses me-2"></i> Fasilitas Umum Kost Regol 2
                    </a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse" href="#submenu-checkin">
                    <span><i class="bi bi-box-arrow-in-right me-2"></i> Check In </span>
                    <i class="bi bi-chevron-down"></i>
                </a>

                <div class="collapse ps-3" id="submenu-checkin">
                    <a href="/checkin_cibiru1" class="nav-link text-white small">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Check In Kost Cibiru 1
                    </a>
                   <a href="/checkin_cibiru2" class="nav-link text-white small">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Check In Kost Cibiru 2
                    </a>
                   <a href="/checkin_regol1" class="nav-link text-white small">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Check In Kost Regol 1
                    </a>
                    <a href="/checkin_regol2" class="nav-link text-white small">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Check In Kost Regol 2
                    </a>
                </div>
            </li>

             <li class="nav-item">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse" href="#submenu-checkout">
                    <span><i class="bi bi-box-arrow-right me-2"></i> Check Out </span>
                    <i class="bi bi-chevron-down"></i>
                </a>

                <div class="collapse ps-3" id="submenu-checkout">
                    <a href="/checkout_cibiru1" class="nav-link text-white small">
                        <i class="bi bi-box-arrow-right me-2"></i> Check Out Kost Cibiru 1
                    </a>
                   <a href="/checkout_cibiru2" class="nav-link text-white small">
                        <i class="bi bi-box-arrow-right me-2"></i> Check Out Kost Cibiru 2
                    </a>
                   <a href="/checkout_regol1" class="nav-link text-white small">
                        <i class="bi bi-box-arrow-right me-2"></i> Check Out Kost Regol 1
                    </a>
                    <a href="/checkout_regol2" class="nav-link text-white small">
                        <i class="bi bi-box-arrow-right me-2"></i> Check Out Kost Regol 2
                    </a>
                </div>
            </li>

            <li class="nav-item">
                <a href="/user" class="nav-link text-white">
                    <i class="bi bi-person-gear me-2"></i> Management User
                </a>
            </li>

         <li class="nav-item">
    <a href="#" class="nav-link text-danger"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right me-2"></i> Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</li>

            <!-- <li class="nav-item">
                <a href="#" class="nav-link text-white">
                    <i class="bi bi-box-arrow-right me-2"></i> Check Out
                </a>
            </li> -->

        </ul>
    </div>
</nav>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('collapsed');
}
</script>
