<?php
require_once "../../includes/config.php";
if (!is_logged_in() || !is_admin()) {
    header("Location: ../../auth/login.php");
    exit;
}

$page_title = "Manajemen Transaksi - Admin";
require_once "../../includes/header.php";

// Ambil data transaksi join user & kategori
$result = $mysqli->query("
  SELECT t.*, u.nama AS user_nama, k.nama AS kategori_nama
  FROM transaksi t
  JOIN users u ON t.user_id = u.id
  LEFT JOIN kategori k ON t.kategori_id = k.id
  ORDER BY t.tanggal DESC
");
?>

<div class="py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Transaksi</h3>
    <a href="tambah.php" class="btn btn-primary">+ Tambah Transaksi</a>
  </div>

  <table class="table table-bordered table-striped">
    <thead class="thead-dark">
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>User</th>
        <th>Kategori</th>
        <th>Tipe</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['tanggal']) ?></td>
          <td><?= htmlspecialchars($row['user_nama']) ?></td>
          <td><?= htmlspecialchars($row['kategori_nama'] ?? '-') ?></td>
          <td><?= ucfirst($row['tipe']) ?></td>
          <td>Rp <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
          <td><?= htmlspecialchars($row['keterangan']) ?></td>
          <td>
            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<?php require_once "../../includes/footer.php"; ?>
