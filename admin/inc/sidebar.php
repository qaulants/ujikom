<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color:#191f36;" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <img width="40" src="washing-machine.png" alt="">
    <div class="sidebar-brand-text mx-3">Laundry_QT</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <?php if($_SESSION['id_level'] == 1): ?>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
      aria-expanded="true" aria-controls="collapseOne">
      <i class="fas fa-fw fa-user"></i>
      <span>Master Data</span>
    </a>
    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="user.php">User</a>
        <a class="collapse-item" href="customer.php">Pelanggan</a>
        <a class="collapse-item" href="level.php">Level</a>
        <a class="collapse-item" href="paket.php">Paket</a>
      </div>
    </div>
  </li>
  <?php endif; ?>

  <hr class="sidebar-divider my-0">

  <?php if($_SESSION['id_level'] == 2): ?>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
      aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Transaksi</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="transaksi.php">Transaksi</a>
        <a class="collapse-item" href="trans-pickup.php">Pengembalian</a>
        <a class="collapse-item" href="laporan.php">Laporan</a>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <hr class="sidebar-divider my-0">


  <?php if($_SESSION['id_level'] == 3): ?>
  <li class="p-1 nav-item">
    <a class="nav-link" href="laporan.php">
    <i class="fa-solid fa-file"></i>
      <span style="margin-left: 3px">Laporan</span></a>
  </li>
  <?php endif; ?>
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline mt-3">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>


</ul>
<!-- End of Sidebar -->