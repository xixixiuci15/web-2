<?php
require_once __DIR__ . '/../models/Produk.php';

use models\Produk;

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: list_produk.php");
    exit;
}

$produk = Produk::find($id);
if (!$produk) {
    echo "Produk tidak ditemukan.";
    exit;
}

include '../partials/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Produk</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="list_produk.php">Produk</a></li>
        <li class="breadcrumb-item active">Detail Produk</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Kode</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($produk['kode']) ?></dd>

                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($produk['nama']) ?></dd>

                <dt class="col-sm-3">Deskripsi</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($produk['deskripsi']) ?></dd>

                <dt class="col-sm-3">Harga</dt>
                <dd class="col-sm-9">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></dd>

                <dt class="col-sm-3">Stok</dt>
                <dd class="col-sm-9"><?= $produk['stok'] ?></dd>

                <dt class="col-sm-3">Jenis Produk</dt>
                <dd class="col-sm-9"><?= $produk['jenis_produk_id'] ?></dd>
            </dl>
            <a href="list_produk.php" class="btn btn-secondary">Kembali</a>
            <a href="edit_produk.php?id=<?= $produk['id'] ?>" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>

