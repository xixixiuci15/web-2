<?php
require_once __DIR__ . '/../models/Anggota.php';
use models\Anggota;

// Cek apakah ID ada di URL
if (!isset($_GET['id'])) {
    header("Location: list_anggota.php");
    exit;
}

// Ambil data anggota berdasarkan ID
$anggota = Anggota::find($_GET['id']);

// Cek jika data anggota tidak ditemukan atau tidak valid
if (!$anggota || !is_array($anggota)) {
    header("Location: list_anggota.php");
    exit;
}

if (isset($_POST['submit'])) {
    $data = [
        'id' => $_GET['id'],
        'nama' => $_POST['nama'],
        'status_aktif' => isset($_POST['status_aktif']) ? 1 : 0,
        'pegawai_id' => $_POST['pegawai_id'],
        'kartu_diskon_id' => $_POST['kartu_diskon_id']
    ];
    Anggota::update($data);
    header("Location: list_anggota.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Anggota</title>
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
                    <h1 class="mt-4">Edit Anggota</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list-anggota.php">Anggota</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-user-edit me-1"></i>
                            Form Edit Anggota
                        </div>
                        <div class="card-body">
                            <form action="edit_anggota.php?id=<?= $anggota['id'] ?>" method="POST">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Anggota</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= isset($anggota['nama']) ? htmlspecialchars($anggota['nama']) : '' ?>" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="status_aktif" name="status_aktif" <?= isset($anggota['status_aktif']) && $anggota['status_aktif'] ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="status_aktif">Status Aktif</label>
                                </div>
                                <div class="mb-3">
                                    <label for="pegawai_id" class="form-label">NIP (ID Pegawai)</label>
                                    <input type="text" class="form-control" id="pegawai_id" name="pegawai_id" value="<?= isset($anggota['pegawai_id']) ? htmlspecialchars($anggota['pegawai_id']) : '' ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kartu_diskon_id" class="form-label">ID Kartu Diskon</label>
                                    <input type="text" class="form-control" id="kartu_diskon_id" name="kartu_diskon_id" value="<?= isset($anggota['kartu_diskon_id']) ? htmlspecialchars($anggota['kartu_diskon_id']) : '' ?>" required>
                                </div>
                                <a href="list_anggota.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Batal</a>
                                <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update</button>
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
