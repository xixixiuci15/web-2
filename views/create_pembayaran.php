<?php
require_once '../config/connection.php';

use config\Connection;

$pdo = Connection::make();

// Ambil data pesanan jika ada ID dikirim
$pesanan = null;
$totalBayar = 0;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT 
                p.id, p.diskon, p.tanggal,
                pg.nama AS nama_anggota,
                COALESCE(SUM(dp.jumlah * pr.harga), 0) AS subtotal
            FROM pesanan p
            JOIN anggota a ON p.anggota_id = a.id
            JOIN pegawai pg ON a.pegawai_id = pg.id
            LEFT JOIN detail_pesanan dp ON p.id = dp.pesanan_id
            LEFT JOIN produk pr ON dp.produk_id = pr.id
            WHERE p.id = :id
            GROUP BY p.id, p.diskon, p.tanggal, pg.nama";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $pesanan = $stmt->fetch();

    if ($pesanan) {
        $totalBayar = $pesanan['subtotal'] * (1 - ($pesanan['diskon'] / 100));
    }
}

// Proses simpan pembayaran
if (isset($_POST['submit'])) {
    $stmt = $pdo->prepare("INSERT INTO pembayaran (pesanan_id, tanggal, jumlah_bayar) VALUES (:pid, :tgl, :jumlah)");
    $stmt->execute([
        ':pid' => $_POST['pesanan_id'],
        ':tgl' => $_POST['tanggal'],
        ':jumlah' => $_POST['jumlah_bayar']
    ]);

    // Update status pesanan jadi Lunas
    $pdo->prepare("UPDATE pesanan SET status_bayar = 1 WHERE id = :id")->execute(['id' => $_POST['pesanan_id']]);

    header("Location: list_pembayaran.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pembayaran Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include '../partials/navbar.php'; ?>
    <div id="layoutSidenav">
        <?php include '../partials/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main class="container-fluid px-4">
                <h1 class="mt-4">Pembayaran Pesanan</h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-money-bill-wave me-1"></i> Form Pembayaran
                    </div>
                    <div class="card-body">
                        <?php if ($pesanan): ?>
                            <form method="POST">
                                <input type="hidden" name="pesanan_id" value="<?= $pesanan['id'] ?>">
                                <input type="hidden" name="jumlah_bayar" value="<?= $totalBayar ?>">
                                <input type="hidden" name="tanggal" value="<?= date('Y-m-d') ?>">

                                <div class="mb-3">
                                    <label>ID Pesanan</label>
                                    <input type="text" class="form-control" value="<?= $pesanan['id'] ?>" disabled>
                                </div>

                                <div class="mb-3">
                                    <label>Nama Anggota</label>
                                    <input type="text" class="form-control" value="<?= $pesanan['nama_anggota'] ?>" disabled>
                                </div>

                                <div class="mb-3">
                                    <label>Subtotal</label>
                                    <input type="text" class="form-control" value="Rp<?= number_format($pesanan['subtotal'], 0, ',', '.') ?>" disabled>
                                </div>

                                <div class="mb-3">
                                    <label>Diskon</label>
                                    <input type="text" class="form-control" value="<?= $pesanan['diskon'] ?>%" disabled>
                                </div>

                                <div class="mb-3">
                                    <label>Total Bayar</label>
                                    <input type="text" class="form-control" value="Rp<?= number_format($totalBayar, 0, ',', '.') ?>" disabled>
                                </div>

                                <button type="submit" name="submit" class="btn btn-success">
                                    <i class="fas fa-check-circle"></i> Bayar
                                </button>
                                <a href="list_pesanan.php" class="btn btn-secondary">Kembali</a>
                            </form>
                        <?php else: ?>
                            <div class="alert alert-warning">Data pesanan tidak ditemukan.</div>
                        <?php endif; ?>
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