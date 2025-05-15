<?php
require_once '../config/Connection.php';

use config\Connection;

$conn = Connection::make();

$jumlahAnggota = $conn->query("SELECT COUNT(*) as total FROM anggota")->fetch(PDO::FETCH_ASSOC)['total'];
$jumlahProduk = $conn->query("SELECT COUNT(*) as total FROM produk")->fetch(PDO::FETCH_ASSOC)['total'];
$jumlahPesanan = $conn->query("SELECT COUNT(*) as total FROM pesanan")->fetch(PDO::FETCH_ASSOC)['total'];
$jumlahPembayaran = $conn->query("SELECT COUNT(*) as total FROM pembayaran")->fetch(PDO::FETCH_ASSOC)['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Dashboard Koperasi Pegawai" />
    <meta name="author" content="Admin" />
    <title>Dashboard Koperasi</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include_once '../partials/navbar.php'; ?>
    <div id="layoutSidenav">
        <?php include_once '../partials/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Beranda</li>
                    </ol>

                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Anggota: <?= $jumlahAnggota ?></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Produk: <?= $jumlahProduk ?></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Pesanan: <?= $jumlahPesanan ?></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Pembayaran: <?= $jumlahPembayaran ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-info-circle me-1"></i> Selamat datang</div>
                        <div class="card-body">
                            <p>Gunakan menu di sebelah kiri untuk mengelola:</p>
                            <ul>
                                <li><strong>Manajemen Anggota</strong> - Tambah, ubah, dan kelola data anggota</li>
                                <li><strong>Data Produk</strong> - Kelola stok dan informasi produk</li>
                                <li><strong>Pemesanan</strong> - Catat pembelian produk oleh anggota</li>
                                <li><strong>Transaksi Keuangan</strong> - Lihat dan atur pembayaran</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </main>
            <?php include_once '../partials/footer.php'; 
            ?>
        </div>
    </div>
</body>

</html>