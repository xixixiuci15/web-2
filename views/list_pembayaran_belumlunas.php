<?php
require_once '../config/Connection.php';

use config\Connection;

$pdo = Connection::make();

$stmt = $pdo->prepare("SELECT 
                            p.id, 
                            pg.nama AS nama_anggota, 
                            p.tanggal, 
                            p.diskon, 
                            p.status_bayar, 
                            GROUP_CONCAT(pr.nama SEPARATOR ', ') AS daftar_produk, 
                            COALESCE(SUM(dp.jumlah * pr.harga), 0) AS subtotal, 
                            COALESCE(SUM(dp.jumlah), 0) AS total_jumlah 
                        FROM pesanan p
                        LEFT JOIN anggota a ON p.anggota_id = a.id
                        LEFT JOIN pegawai pg ON a.pegawai_id = pg.id
                        LEFT JOIN detail_pesanan dp ON p.id = dp.pesanan_id
                        LEFT JOIN produk pr ON dp.produk_id = pr.id
                        WHERE p.status_bayar = 0
                        GROUP BY p.id");

$stmt->execute();
$pesananList = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Daftar Pembayaran Belum Lunas</title>
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
                <h1 class="mt-4">Daftar Pembayaran yang Belum Lunas</h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-receipt me-1"></i> Tabel Pembayaran
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID Pesanan</th>
                                    <th>Nama Anggota</th>
                                    <th>Tanggal</th>
                                    <th>Total Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Diskon</th>
                                    <th>Total Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pesananList as $data):
                                    $subtotal = $data['subtotal'] ?? 0;  // Pastikan subtotal tidak null
                                    $diskon = $data['diskon'] ?? 0;  // Pastikan diskon tidak null
                                    $totalBayar = $subtotal * (1 - ($diskon / 100));  // Perhitungan total bayar
                                ?>
                                    <tr>
                                        <td><?= htmlspecialchars($data['id']) ?></td>
                                        <td><?= htmlspecialchars($data['nama_anggota']) ?></td>
                                        <td><?= date('d-m-Y', strtotime($data['tanggal'])) ?></td>
                                        <td><?= htmlspecialchars($data['total_jumlah']) ?></td>
                                        <td>Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
                                        <td><?= $diskon ?>%</td>
                                        <td>Rp<?= number_format($totalBayar, 0, ',', '.') ?></td>
                                        <td>
                                            <a href="create_pembayaran.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-success">
                                                <i class="fas fa-money-bill-wave"></i> Bayar
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
            <?php include '../partials/footer.php'; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/scripts.js"></script>
</body>

</html>