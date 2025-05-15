<?php
require_once __DIR__ . '/../config/connection.php';
require_once __DIR__ . '/../models/jenis_produk.php';

use config\Connection;
use models\JenisProduk;

// Ambil semua jenis produk untuk dropdown
$jenisProduk = JenisProduk::all();

// Mengecek apakah form telah disubmit
if (isset($_POST['submit'])) {
    $pdo = Connection::make();

    // Simpan data produk ke database
    $stmt = $pdo->prepare('INSERT INTO produk (nama, deskripsi, harga, stok, jenis_produk_id) 
                           VALUES (:nama, :deskripsi, :harga, :stok, :jenis_produk_id)');
    $stmt->bindParam(':nama', $_POST['nama_produk']);
    $stmt->bindParam(':deskripsi', $_POST['deskripsi']);
    $stmt->bindParam(':harga', $_POST['harga']);
    $stmt->bindParam(':stok', $_POST['stok']);
    $stmt->bindParam(':jenis_produk_id', $_POST['jenis_produk_id']);
    $stmt->execute();

    // Redirect ke halaman list produk
    header("Location: list_produk.php");
    exit;
}
?>

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include '../partials/navbar.php'; ?>
    <div id="layoutSidenav">
        <?php include '../partials/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tambah Produk</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list_produk.php">Produk</a></li>
                        <li class="breadcrumb-item active">Tambah Produk</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-box me-1"></i> Form Tambah Produk</div>
                        <div class="card-body">
                            <form action="create_produk.php" method="POST">
                                <!-- Nama Produk -->
                                <div class="mb-3">
                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" name="nama_produk" required>
                                </div>

                                <!-- Deskripsi -->
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                                </div>

                                <!-- Harga -->
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" name="harga" required>
                                </div>

                                <!-- Stok -->
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" class="form-control" name="stok" required>
                                </div>

                                <!-- Jenis Produk -->
                                <div class="mb-3">
                                    <label for="jenis_produk_id" class="form-label">Jenis Produk</label>
                                    <select name="jenis_produk_id" class="form-control" required>
                                        <?php foreach ($jenisProduk as $j): ?>
                                            <option value="<?= $j['id'] ?>"><?= $j['nama_jenis_produk'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Tombol -->
                                <a href="list_produk.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" name="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../partials/footer.php'; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../public/js/scripts.js"></script>
</body>

</html>