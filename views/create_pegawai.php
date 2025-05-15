<?php
require_once __DIR__ . '/../config/connection.php';
require_once __DIR__ . '/../models/anggota.php';

use config\Connection;
use models\Anggota;

if (isset($_POST['submit'])) {
    $pdo = Connection::make();

    $stmt = $pdo->prepare('INSERT INTO pegawai (nip, nama, jenis_kelamin, jabatan) VALUES (:nip, :nama, :jk, :jabatan)');
    $stmt->bindParam(':nip', $_POST['nip']);
    $stmt->bindParam(':nama', $_POST['nama']);
    $stmt->bindParam(':jk', $_POST['jenis_kelamin']);
    $stmt->bindParam(':jabatan', $_POST['jabatan']);
    
    if ($stmt->execute()) {
        $pegawai_id = $pdo->lastInsertId();
        echo "<script>alert('Data pegawai berhasil disimpan!'); window.location.href='list_pegawai.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pegawai</title>
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
                <h1 class="mt-4">Tambah Pegawai</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="list_pegawai.php">Pegawai</a></li>
                    <li class="breadcrumb-item active">Tambah Pegawai</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-user-plus me-1"></i> Form Tambah Pegawai</div>
                    <div class="card-body">
                        <form action="create_pegawai.php" method="POST">
                            <h5>Data Pegawai</h5>
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" class="form-control" name="nip" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" required>
                            </div>
                            <a href="list_pegawai.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
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
