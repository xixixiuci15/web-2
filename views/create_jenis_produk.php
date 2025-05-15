<?php
require_once __DIR__ . '/../models/jenis_produk.php';

use models\JenisProduk;

if (isset($_POST['submit'])) {
   
    $data = [
        'nama_jenis_produk' => $_POST['nama_jenis_produk'],
        'deskripsi' => $_POST['deskripsi']
    ];

    
    JenisProduk::create($data);

   
    header("Location: list_jenis_produk.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Jenis Produk</title>
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
                    <h1 class="mt-4">Tambah Jenis Produk</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list_jenis_produk.php">Jenis Produk</a></li>
                        <li class="breadcrumb-item active">Tambah Jenis Produk</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-plus me-1"></i> Form Tambah Jenis Produk
                        </div>
                        <div class="card-body">
                            <form action="create_jenis_produk.php" method="POST">
                                <div class="mb-3">
                                    <label for="nama_jenis_produk" class="form-label">Nama Jenis Produk</label>
                                    <input type="text" class="form-control" name="nama_jenis_produk" id="nama_jenis_produk" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" required></textarea>
                                </div>
                                <a href="list_jenis_produk.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
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