<?php
require_once __DIR__ . '/../models/pesanan.php';
use models\Anggota;
use models\Pesanan;

$id = $_GET['id'];

if ($id) {
    Pesanan::delete($id); 
}

header("Location: list_pesanan.php");
exit;
