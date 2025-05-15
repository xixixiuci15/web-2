<?php
require_once __DIR__ . '/../models/Anggota.php';
use models\Anggota;

if (!isset($_GET['id'])) {
    header("Location: list_anggota.php");
    exit;
}

$anggota = Anggota::find($_GET['id']);

if (!$anggota || !is_array($anggota)) {
    header("Location: list_anggota.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Detail Anggota</title>
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
                    <h1 class="mt-4">Detail Anggota</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list_anggota.php">Anggota</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-user me-1"></i>
                            Informasi Lengkap Anggota
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Status Aktif</th>
                                    <td><?= $anggota['status_aktif'] ? 'Aktif' : 'Tidak Aktif' ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Pegawai</th>
                                    <td><?= htmlspecialchars($anggota['nama_pegawai']) ?></td>
                                </tr>
                                <tr>
                                    <th>NIP (pegawai_id)</th>
                                    <td><?= htmlspecialchars($anggota['pegawai_id']) ?></td>
                                </tr>
                                <tr>
                                    <th>Jabatan</th>
                                    <td><?= htmlspecialchars($anggota['jabatan']) ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td><?= htmlspecialchars($anggota['jenis_kelamin']) ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Kartu Diskon</th>
                                    <td><?= isset($anggota['nama_diskon']) ? htmlspecialchars($anggota['nama_diskon']) : '-' ?></td>
                                </tr>
                                <tr>
                                    <th>Persentase Diskon</th>
                                    <td><?= isset($anggota['persentase']) ? $anggota['persentase'] . '%' : '-' ?></td>
                                </tr>
                            </table>

                            <div class="mt-3">
                                <a href="list_anggota.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                                <a href="edit_anggota.php?id=<?= $anggota['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                <a href="delete_anggota.php?id=<?= $anggota['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i> Hapus</a>
                            </div>
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
