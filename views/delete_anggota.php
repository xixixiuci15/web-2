<?php
require_once __DIR__ . '/../models/anggota.php';
use models\Anggota;

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        Anggota::delete($id);
        header("Location: list_anggota.php?success=1");
        exit;
    } catch (Exception $e) {
        echo "<script>
            alert('Gagal menghapus anggota: {$e->getMessage()}');
            window.location.href = 'list_anggota.php';
        </script>";
        exit;
    }
} else {
    header("Location: list_anggota.php");
    exit;
}
