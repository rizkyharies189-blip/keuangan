<?php
// auth/login.php
require_once "../includes/config.php";

if (isset($_SESSION['user_id'])) {
    // sudah login -> redirect ke dashboard sesuai role
    header("Location: " . (is_admin() ? "../admin/dashboard.php" : "../user/dashboard.php"));
    exit;
}

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $err = "Email dan password harus diisi.";
    } else {
        $stmt = $mysqli->prepare("SELECT id, nama, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($row = $res->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                // set session
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['nama'] = $row['nama'];
                $_SESSION['role'] = $row['role'];

                // redirect
                if ($row['role'] === 'admin') {
                    header("Location: ../admin/dashboard.php");
                } else {
                    header("Location: ../user/dashboard.php");
                }
                exit;
            } else {
                $err = "Email atau password salah.";
            }
        } else {
            $err = "Email atau password salah.";
        }
        $stmt->close();
    }
}

$page_title = "Login - Manajemen Keuangan";
require_once "../includes/header.php";
?>

<div class="row justify-content-center py-5">
  <div class="col-md-5">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Login</h4>
        <?php if ($err): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($err) ?></div>
        <?php endif; ?>
        <form method="post" action="">
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button class="btn btn-primary btn-block" type="submit">Masuk</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require_once "../includes/footer.php"; ?>
