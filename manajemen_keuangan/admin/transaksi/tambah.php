<?php
require_once "../../includes/config.php";
if (!is_logged_in() || !is_admin()) {
    header("Location: ../../auth/login.php");
    exit;
}

$page_title = "Tambah Transaksi";
require_once "../../includes/header.php";

// Ambil kategori
$kategori = $mysqli->query("SELECT * FROM kategori ORDER BY nama ASC");

// Simpan jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $kategori_id = $_POST['kategori_id'];
    $tipe = $_POST['tipe'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];
    $tanggal = $_POST['tanggal'];

    $stmt = $mysqli->prepare("INSERT INTO transaksi (user_id, kategori_id, tipe, jumlah, keterangan, tanggal) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("iisdss", $user_id, $kategori_id, $tipe, $jumlah, $keterangan, $tanggal);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit;
}
?>

<div class="py-4">
  <h3>Tambah Transaksi</h3>
  <form method="post">
    <div class="form-group">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Kategori</label>
      <select name="kategori_id" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>
        <?php while ($k = $kategori->fetch_assoc()): ?>
          <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['nama']) ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="form-group">
      <label>Tipe</label>
      <select name="tipe" class="form-control" required>
        <option value="pemasukan">Pemasukan</option>
        <option value="pengeluaran">Pengeluaran</option>
      </select>
    </div>
    <div class="form-group">
      <label>Jumlah</label>
      <input type="number" name="jumlah" class="form-control" step="0.01" required>
    </div>
    <div class="form-group">
      <label>Keterangan</label>
      <textarea name="keterangan" class="form-control"></textarea>
    </div>
    <button class="btn btn-success" type="submit">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php require_once "../../includes/footer.php"; ?>
