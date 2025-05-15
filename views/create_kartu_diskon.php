<?php
require_once __DIR__ . '/../config/connection.php';

use config\Connection;

if (isset($_POST['submit'])) {
    $pdo = Connection::make();

    // Simpan data kartu diskon
    $stmt = $pdo->prepare('INSERT INTO kartu_diskon (nama, persen_diskon, deskripsi) VALUES (:nama, :persen_diskon, :deskripsi)');
    $stmt->bindParam(':nama', $_POST['nama']);
    $stmt->bindParam(':persen_diskon', $_POST['persen_diskon']);
    $stmt->bindParam(':deskripsi', $_POST['deskripsi']);
    $stmt->execute();

    header("Location: list_kartu_diskon.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kartu Diskon</title>
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
                <h1 class="mt-4">Tambah Kartu Diskon</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="list_kartu_diskon.php">Kartu Diskon</a></li>
                    <li class="breadcrumb-item active">Tambah Kartu Diskon</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-tags me-1"></i> Form Tambah Kartu Diskon</div>
                    <div class="card-body">
                        <form action="create_kartu_diskon.php" method="POST">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Kartu</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="persen_diskon" class="form-label">Persentase Diskon</label>
                                <input type="number" class="form-control" name="persen_diskon" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                            </div>

                            <a href="list_kartu_diskon.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
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
