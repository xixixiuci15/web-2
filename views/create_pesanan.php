<?php
require_once '../config/Connection.php';

use config\Connection;

$pdo = Connection::make();
$anggota = $pdo->query("SELECT a.id, k.persen_diskon FROM anggota a LEFT JOIN kartu_diskon k ON a.kartu_diskon_id = k.id")->fetchAll();
$produk = $pdo->query("SELECT id, nama FROM produk")->fetchAll();

if (isset($_POST['submit'])) {
    $anggota_id = $_POST['anggota_id'];
    $produk_id = $_POST['produk_id'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];
    $status_bayar = $_POST['status_bayar'];

    // Ambil diskon dari anggota
    $stmtDiskon = $pdo->prepare("SELECT k.persen_diskon FROM anggota a LEFT JOIN kartu_diskon k ON a.kartu_diskon_id = k.id WHERE a.id = :aid");
    $stmtDiskon->execute([':aid' => $anggota_id]);
    $diskon = $stmtDiskon->fetchColumn() ?? 0;

    // Simpan ke tabel pesanan
    $stmtPesanan = $pdo->prepare("INSERT INTO pesanan (anggota_id, tanggal, status_bayar, diskon) VALUES (:aid, :tgl, :status, :diskon)");
    $stmtPesanan->execute([
        ':aid' => $anggota_id,
        ':tgl' => $tanggal,
        ':status' => $status_bayar,
        ':diskon' => $diskon
    ]);

    $pesanan_id = $pdo->lastInsertId();

    // Simpan ke detail_pesanan
    $stmtDetail = $pdo->prepare("INSERT INTO detail_pesanan (pesanan_id, produk_id, jumlah) VALUES (:pid, :prid, :jml)");
    $stmtDetail->execute([
        ':pid' => $pesanan_id,
        ':prid' => $produk_id,
        ':jml' => $jumlah
    ]);

    header("Location: list_pesanan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Pesanan</title>
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
                    <h1 class="mt-4">Tambah Pesanan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list_pesanan.php">Pesanan</a></li>
                        <li class="breadcrumb-item active">Tambah Pesanan</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-cart-plus me-1"></i> Form Tambah Pesanan</div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="anggota_id" class="form-label">Anggota (dengan Diskon)</label>
                                    <select name="anggota_id" class="form-control" required>
                                        <?php foreach ($anggota as $a): ?>
                                            <option value="<?= $a['id'] ?>">
                                                ID: <?= $a['id'] ?> - Diskon: <?= $a['persen_diskon'] ?? 0 ?>%
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="produk_id" class="form-label">Produk</label>
                                    <select name="produk_id" class="form-control" required>
                                        <?php foreach ($produk as $p): ?>
                                            <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" required class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Pesan</label>
                                    <input type="date" name="tanggal" required class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="status_bayar" class="form-label">Status Bayar</label>
                                    <select name="status_bayar" class="form-control" required>
                                        <option value="1">Lunas</option>
                                        <option value="0">Belum Lunas</option>
                                    </select>
                                </div>
                                <a href="list_pesanan.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                                <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
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