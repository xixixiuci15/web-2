<?php
require_once __DIR__ . '/../config/Connection.php';

use config\Connection;

$pdo = Connection::make();

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM kartu_diskon WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    $stmt = $pdo->prepare("UPDATE kartu_diskon SET nama = ?, persen_diskon = ?, deskripsi = ? WHERE id = ?");
    $stmt->execute([
        $_POST['nama'],
        $_POST['persen_diskon'],
        $_POST['deskripsi'],
        $id
    ]);
    header("Location: list_kartu_diskon.php");
    exit;
}
?>

<h2>Edit Kartu Diskon</h2>
<form method="POST">
    <label>Nama</label><input name="nama" value="<?= $data['nama'] ?>" class="form-control" required><br>
    <label>Persen Diskon (%)</label><input name="persen_diskon" type="number" value="<?= $data['persen_diskon'] ?>" class="form-control" required><br>
    <label>Deskripsi</label><textarea name="deskripsi" class="form-control"><?= $data['deskripsi'] ?></textarea><br>
    <button name="submit" class="btn btn-primary">Simpan</button>
</form>
