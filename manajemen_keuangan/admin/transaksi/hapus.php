<?php
require_once "../../includes/config.php";
if (!is_logged_in() || !is_admin()) {
    header("Location: ../../auth/login.php");
    exit;
}

$id = $_GET['id'] ?? 0;
$mysqli->query("DELETE FROM transaksi WHERE id = $id");
header("Location: index.php");
exit;
