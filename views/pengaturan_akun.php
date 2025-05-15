<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once '../config/Connection.php';
use config\Connection;

$pdo = Connection::make();
$user = $_SESSION['user'];

// Handle update data akun
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    // Update di database (misal tabel pengguna/admin)
    $stmt = $pdo->prepare("UPDATE pengguna SET nama = ?, email = ? WHERE id = ?");
    $stmt->execute([$nama, $email, $user['id']]);

    // Update session
    $_SESSION['user']['nama'] = $nama;
    $_SESSION['user']['email'] = $email;

    $success = true;
}

include '../partials/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Pengaturan Akun</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Pengaturan Akun</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <?php if (!empty($success)): ?>
                <div class="alert alert-success">Data berhasil diperbarui!</div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" required value="<?= htmlspecialchars($user['nama']) ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($user['email']) ?>">
                </div>
                <button class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
