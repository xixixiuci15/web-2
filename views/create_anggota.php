<?php
require_once __DIR__ . '/../models/kartu_diskon.php';
require_once __DIR__ . '/../models/anggota.php';
require_once __DIR__ . '/../config/connection.php';

use config\Connection;
use models\Anggota;
use models\KartuDiskon;

$pdo = Connection::make();


$stmt = $pdo->query("SELECT * FROM pegawai WHERE id NOT IN (SELECT pegawai_id FROM anggota)");
$pegawaiList = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    
    $dataAnggota = [
        'pegawai_id' => $_POST['pegawai_id'],
        'status_aktif' => $_POST['status_aktif'],
        'kartu_diskon_id' => !empty($_POST['kartu_diskon_id']) ? $_POST['kartu_diskon_id'] : null
    ];
    Anggota::create($dataAnggota);

    header("Location: list_anggota.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Anggota Baru</title>
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
                <h1 class="mt-4">Tambah Anggota</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="list_anggota.php">Anggota</a></li>
                    <li class="breadcrumb-item active">Tambah Anggota</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-user-plus me-1"></i> Form Tambah Anggota</div>
                    <div class="card-body">
                        <form action="create_anggota.php" method="POST">
                            <h5>Data Pegawai</h5>
                            <div class="mb-3">
                                <label for="pegawai_id" class="form-label">Pilih Pegawai</label>
                                <select name="pegawai_id" class="form-control" required>
                                    <option value="">-- Pilih Pegawai --</option>
                                    <?php foreach ($pegawaiList as $pegawai): ?>
                                        <option value="<?= $pegawai['id']; ?>">
                                            <?= $pegawai['nip'] . ' - ' . $pegawai['nama']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <h5 class="mt-4">Data Anggota</h5>
                            <div class="mb-3">
                                <label for="status_aktif" class="form-label">Status Aktif</label>
                                <select name="status_aktif" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kartu_diskon_id" class="form-label">Kartu Diskon</label>
                                <select name="kartu_diskon_id" class="form-control">
                                    <option value="">-- Tidak Ada --</option>
                                    <?php
                                    $listKartu = KartuDiskon::all();
                                    foreach ($listKartu as $kartu) {
                                        echo "<option value=\"{$kartu['id']}\">{$kartu['nama']} ({$kartu['persen_diskon']}%)</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <a href="list_anggota.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
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
