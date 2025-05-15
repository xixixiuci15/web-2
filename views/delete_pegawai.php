<?php
require_once __DIR__ . '/../models/pegawai.php';
use models\Anggota;
use models\Pegawai;

$id = $_GET['id'];

if ($id) {
    Pegawai::delete($id); 
}

header("Location: list_pegawai.php");
exit;
