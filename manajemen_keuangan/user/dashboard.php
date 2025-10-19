<?php
require_once "../includes/config.php";
if (!is_logged_in()) {
    header("Location: ../auth/login.php");
    exit;
}
$page_title = "User Dashboard";
require_once "../includes/header.php";
?>
<div class="py-5">
  <h2>User Dashboard</h2>
  <p>Selamat datang, <?= htmlspecialchars($_SESSION['nama']) ?>. Ini halaman user (placeholder).</p>
</div>
<?php require_once "../includes/footer.php"; ?>
