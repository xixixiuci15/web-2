<?php
require_once __DIR__ . '/../models/anggota.php';

use models\Anggota;

$anggotas = Anggota::all();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>List Anggota</title>
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
                    <h1 class="mt-4">Anggota</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Anggota</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> List Anggota
                        </div>
                        <div class="card-body">
                            <div class="mb-3 text-end">
                                <a href="create_anggota.php" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Tambah Anggota
                                </a>
                            </div>
                            <table id="datatablesSimple" class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Status Aktif</th>
                                        <th>Nama Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Kartu Diskon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($anggotas as $index => $anggota): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= $anggota['status_aktif'] == 1 ? 'Aktif' : 'Tidak Aktif' ?></td>
                                            <td><?= htmlspecialchars($anggota['nama_pegawai']) ?></td>
                                            <td><?= htmlspecialchars($anggota['jabatan']) ?></td>
                                            <td><?= htmlspecialchars($anggota['jenis_kelamin']) ?></td>
                                            <td>
                                                <?php if (!empty($anggota['nama_diskon'])): ?>
                                                    <?= htmlspecialchars($anggota['nama_diskon']) ?> (<?= (int)$anggota['persen_diskon'] ?>%)
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="detail_anggota.php?id=<?= $anggota['id'] ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                                <a href="edit_anggota.php?id=<?= $anggota['id'] ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="delete_anggota.php?id=<?= $anggota['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include_once '../partials/footer.php'; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../public/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../public/js/datatables-simple-demo.js"></script>
</body>

</html>