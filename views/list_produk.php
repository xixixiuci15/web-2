<?php
require_once __DIR__ . '/../config/Connection.php';

use config\Connection;

$pdo = Connection::make();

// Ambil data produk dan nama jenis produknya
$sql = "SELECT p.*, jp.nama_jenis_produk 
        FROM produk p 
        JOIN jenis_produk jp ON p.jenis_produk_id = jp.id 
        ORDER BY p.id DESC";
$data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>List Produk</title>
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
                    <h1 class="mt-4">Produk</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Produk</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-box me-1"></i> List Produk</div>
                        <div class="card-body">
                            <a href="create_produk.php" class="btn btn-success mb-3">
                                <i class="fas fa-plus"></i> Tambah Produk
                            </a>
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Jenis Produk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $i => $row): ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= htmlspecialchars($row['nama']) ?></td>
                                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                            <td><?= $row['stok'] ?></td>
                                            <td><?= htmlspecialchars($row['nama_jenis_produk']) ?></td>
                                            <td>
                                                <a href="edit_produk.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="delete_produk.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../partials/footer.php'; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
    <script src="../public/js/datatables-simple-demo.js"></script>
</body>

</html>