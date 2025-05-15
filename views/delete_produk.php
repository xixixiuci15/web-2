<?php
require_once __DIR__ . '/../models/produk.php';

use models\Produk;

$id = $_GET['id'] ?? null;

if ($id) {
    Produk::delete($id); 
}

header("Location: list_produk.php");
exit;
