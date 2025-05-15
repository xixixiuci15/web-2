<?php
require_once '../config/Connection.php';

use config\Connection;

$pdo = Connection::make();

$sql = "SELECT 
            p.id, 
            pg.nama AS nama_anggota,
            p.tanggal, 
            p.diskon, 
            p.status_bayar,
            GROUP_CONCAT(pr.nama SEPARATOR ', ') AS nama_produk,
            COALESCE(SUM(dp.jumlah * pr.harga), 0) AS subtotal,
            COALESCE(SUM(dp.jumlah), 0) AS total_jumlah
        FROM pesanan p
        LEFT JOIN anggota a ON p.anggota_id = a.id
        LEFT JOIN pegawai pg ON a.pegawai_id = pg.id
        LEFT JOIN detail_pesanan dp ON p.id = dp.pesanan_id
        LEFT JOIN produk pr ON dp.produk_id = pr.id
        GROUP BY p.id, pg.nama, p.tanggal, p.diskon, p.status_bayar";

$pesanan = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Pesanan</title>
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
                    <h1 class="mt-4">Pesanan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pesanan</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> Daftar Pesanan
                            <a href="create_pesanan.php" class="btn btn-sm btn-primary float-end"><i class="fas fa-plus"></i> Tambah</a>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Anggota</th>
                                        <th>Produk</th>
                                        <th>Total Jumlah</th>
                                        <th>Subtotal</th>
                                        <th>Diskon</th>
                                        <th>Total Bayar</th>
                                        <th>Tanggal</th>
                                        <th>Status Bayar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pesanan as $p):
                                        $subtotal = $p['subtotal'];
                                        $diskon = $p['diskon'];
                                        $totalBayar = $subtotal * (1 - ($diskon / 100));
                                    ?>
                                        <tr>
                                            <td><?= $p['id'] ?></td>
                                            <td><?= htmlspecialchars($p['nama_anggota'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($p['nama_produk'] ?? '-') ?></td>
                                            <td><?= $p['total_jumlah'] ?></td>
                                            <td>Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
                                            <td><?= $diskon ?>%</td>
                                            <td>Rp<?= number_format($totalBayar, 0, ',', '.') ?></td>
                                            <td><?= date('d-m-Y', strtotime($p['tanggal'])) ?></td>
                                            <td>
                                                <?php if ($p['status_bayar']): ?>
                                                    <span class="badge bg-success">Lunas</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning text-dark">Belum Lunas</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="edit_pesanan.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <a href="delete_pesanan.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')"><i class="fas fa-trash"></i></a>
                                                <a href="detail_pesanan.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                <?php if (!$p['status_bayar']): ?>
                                                    <a href="create_pembayaran.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-success"><i class="fas fa-money-bill-wave"></i> Bayar</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../partials/footer.php'; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../public/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            new simpleDatatables.DataTable("#datatablesSimple");
        });
    </script>
</body>

</html>