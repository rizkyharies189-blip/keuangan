<?php
require_once "../includes/config.php";
if (!is_logged_in() || !is_admin()) {
    header("Location: ../auth/login.php");
    exit;
}
$page_title = "Admin Dashboard";
require_once "../includes/header.php";
?>
<div class="py-5">
  <h2>Admin Dashboard</h2>
  <p>Selamat datang, <?= htmlspecialchars($_SESSION['nama']) ?>. Ini halaman admin (placeholder).</p>
</div>
<?php require_once "../includes/footer.php"; ?>
