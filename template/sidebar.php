<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $halaman == "Dashboard" ? "active" : '' ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?= $halaman == 'kasir' ? "active" : '' ?>">
        <a class="nav-link" href="?hal=pages/kasir/main.php">
            <i class="fas fa-fw fa-calculator"></i>
            <span>Kasir</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Heading -->
    <div class="sidebar-heading">
        Component
    </div>

    <?php 
    	if($halaman == "barang" || $halaman == "member" || $halaman == "satuan" || $halaman == "kategori"){
    		$aktifasi = "active";
    	}else{
    		$aktifasi = "";
    	}
    ?>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= $aktifasi ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSatu"
            aria-expanded="true" aria-controls="collapseSatu">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master</span>
        </a>
        <div id="collapseSatu" class="collapse" aria-labelledby="headingSatu" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Halaman Master</h6>
                <a class="collapse-item" href="?hal=pages/member/main.php">Member</a>
                <a class="collapse-item" href="?hal=pages/barang/main.php">Barang</a>
                <a class="collapse-item" href="?hal=pages/kategori/main.php">Kategori</a>
                <a class="collapse-item" href="?hal=pages/satuan/main.php">Satuan</a>
            </div>
        </div>
    </li>

    <?php 
    	if($halaman == "lap_member" || $halaman == "lap_barang" || $halaman == "lap_transaksi"){
    		$aktifasi2 = "active";
    	}else{
    		$aktifasi2 = "";
    	}
    ?>
    <li class="nav-item <?= $aktifasi2;?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDua"
            aria-expanded="true" aria-controls="collapseDua">
            <i class="fas fa-fw fa-file"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseDua" class="collapse" aria-labelledby="headingDua" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Halaman Laporan</h6>
                <a class="collapse-item" href="?hal=pages/lap_member/main.php">Member</a>
                <a class="collapse-item" href="?hal=pages/lap_barang/main.php">Barang</a>
                <a class="collapse-item" href="?hal=pages/lap_transaksi/main.php">Transaksi</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->