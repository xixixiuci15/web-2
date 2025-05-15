<?php
require_once __DIR__ . '/../models/jenis_produk.php';

use models\JenisProduk;

$id = $_GET['id'] ?? null;

if ($id) {
    JenisProduk::delete($id); 
}

// Redirect ke halaman list produk
header("Location: list_jenis_produk.php");
exit;
