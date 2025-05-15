<?php
require_once '../config/connection.php';

use config\Connection;

$pdo = Connection::make();

// Ambil semua data pesanan beserta nama anggota
$sql = "SELECT 
            pesanan.id, 
            pesanan.tanggal, 
            pesanan.diskon, 
            pesanan.status_bayar, 
            anggota.id AS anggota_id,
            pegawai.nama AS nama_anggota
        FROM pesanan 
        LEFT JOIN anggota ON pesanan.anggota_id = anggota.id
        LEFT JOIN pegawai ON anggota.pegawai_id = pegawai.id";

$pesanan = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan</title>
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
                <h1 class="mt-4">Riwayat Pesanan</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Riwayat Pesanan</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Tabel Riwayat Pesanan
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Anggota</th>
                                    <th>Tanggal</th>
                                    <th>Diskon</th>
                                    <th>Status Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pesanan as $p): ?>
                                    <tr>
                                        <td><?= $p['id'] ?></td>
                                        <td><?= htmlspecialchars($p['nama_anggota'] ?? 'Tidak diketahui') ?></td>
                                        <td><?= $p['tanggal'] ?></td>
                                        <td><?= $p['diskon'] ?>%</td>
                                        <td>
                                            <?php if ($p['status_bayar']): ?>
                                                <span class="badge bg-success">Lunas</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Belum Lunas</span>
                                            <?php endif; ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../public/js/scripts.js"></script>
</body>

</html>