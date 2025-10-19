<?php
require_once "../../includes/config.php";
if (!is_logged_in() || !is_admin()) {
    header("Location: ../../auth/login.php");
    exit;
}

$id = $_GET['id'] ?? 0;
$result = $mysqli->query("SELECT * FROM transaksi WHERE id=$id");
$data = $result->fetch_assoc();
if (!$data) { header("Location: index.php"); exit; }

$page_title = "Edit Transaksi";
require_once "../../includes/header.php";

$kategori = $mysqli->query("SELECT * FROM kategori ORDER BY nama ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kategori_id = $_POST['kategori_id'];
    $tipe = $_POST['tipe'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];
    $tanggal = $_POST['tanggal'];

    $stmt = $mysqli->prepare("UPDATE transaksi SET kategori_id=?, tipe=?, jumlah=?, keterangan=?, tanggal=? WHERE id=?");
    $stmt->bind_param("isdssi", $kategori_id, $tipe, $jumlah, $keterangan, $tanggal, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit;
}
?>

<div class="py-4">
  <h3>Edit Transaksi</h3>
  <form method="post">
    <div class="form-group">
      <label>Tanggal</label>
      <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Kategori</label>
      <select name="kategori_id" class="form-control" required>
        <?php while ($k = $kategori->fetch_assoc()): ?>
          <option value="<?= $k['id'] ?>" <?= $k['id'] == $data['kategori_id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($k['nama']) ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="form-group">
      <label>Tipe</label>
      <select name="tipe" class="form-control" required>
        <option value="pemasukan" <?= $data['tipe'] == 'pemasukan' ? 'selected' : '' ?>>Pemasukan</option>
        <option value="pengeluaran" <?= $data['tipe'] == 'pengeluaran' ? 'selected' : '' ?>>Pengeluaran</option>
      </select>
    </div>
    <div class="form-group">
      <label>Jumlah</label>
      <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>" class="form-control" step="0.01" required>
    </div>
    <div class="form-group">
      <label>Keterangan</label>
      <textarea name="keterangan" class="form-control"><?= $data['keterangan'] ?></textarea>
    </div>
    <button class="btn btn-success" type="submit">Update</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php require_once "../../includes/footer.php"; ?>
