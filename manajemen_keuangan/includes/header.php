<?php
// includes/header.php
if (!isset($page_title)) $page_title = "Manajemen Keuangan Kampus";
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($page_title) ?></title>

  <!-- Bootstrap (gunakan versi yang kompatibel dengan SB Admin 2, contoh Bootstrap 4) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- custom style -->
  <style>
    .hero {
      padding: 80px 0;
      background: linear-gradient(90deg, #4e73df 0%, #224abe 100%);
      color: white;
    }
    .nav-link { color: rgba(255,255,255,0.9) !important; }
    footer { padding: 20px 0; background:#f8f9fc; margin-top:40px; }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background:#2e59d9;">
    <a class="navbar-brand" href="index.php">Keuangan Kampus</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
          <?php if ($_SESSION['role'] === 'admin'): ?>
            <li class="nav-item"><a class="nav-link" href="admin/dashboard.php">Admin</a></li>
          <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="user/dashboard.php">Dashboard</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="auth/logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="auth/login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
  <main class="container">
