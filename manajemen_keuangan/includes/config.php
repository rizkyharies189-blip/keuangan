<?php
// includes/config.php
session_start();

$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "keuangan_kampus";

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($mysqli->connect_errno) {
    die("Gagal koneksi MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

// helper sederhana
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}
?>
