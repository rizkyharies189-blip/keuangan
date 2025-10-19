<?php
// index.php
$page_title = "Beranda - Manajemen Keuangan Kampus";
require_once "includes/config.php";
require_once "includes/header.php";
?>

<section class="hero text-center">
  <div class="container">
    <h1 class="display-4">Sistem Manajemen Keuangan Kampus</h1>
    <p class="lead">Kelola pemasukan, pengeluaran, dan laporan keuangan kampus secara mudah dan terstruktur.</p>
    <p>
      <a href="auth/login.php" class="btn btn-light btn-lg">Masuk / Login</a>
      <a href="about.php" class="btn btn-outline-light btn-lg">Pelajari lebih lanjut</a>
    </p>
  </div>
</section>

<section class="py-5">
  <div class="row">
    <div class="col-md-4">
      <h4>Catat Transaksi</h4>
      <p>Input pemasukan dan pengeluaran dengan kategori yang rapi.</p>
    </div>
    <div class="col-md-4">
      <h4>Laporan Bulanan</h4>
      <p>Generate laporan keuangan bulanan dan ekspor CSV/PDF.</p>
    </div>
    <div class="col-md-4">
      <h4>Role Admin & User</h4>
      <p>Perbedaan akses: admin untuk manajemen, user untuk melihat histori dan ajukan pengeluaran.</p>
    </div>
  </div>
</section>

<?php require_once "includes/footer.php"; ?>
