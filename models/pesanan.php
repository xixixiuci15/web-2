<?php

namespace models;

require_once __DIR__ . '/../config/Connection.php';

use config\Connection;
use PDO;

class Pesanan
{
    public static function all()
    {
        $pdo = Connection::make();
        $sql = 'SELECT pesanan.*, anggota.id AS anggota_id
                FROM pesanan
                LEFT JOIN anggota ON pesanan.anggota_id = anggota.id';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('SELECT * FROM pesanan WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('INSERT INTO pesanan (tanggal, diskon, status_bayar, anggota_id)
                               VALUES (:tanggal, :diskon, :status_bayar, :anggota_id)');
        $stmt->bindParam(':tanggal', $data['tanggal']);
        $stmt->bindParam(':diskon', $data['diskon']);
        $stmt->bindParam(':status_bayar', $data['status_bayar']);
        $stmt->bindParam(':anggota_id', $data['anggota_id']);
        return $stmt->execute();
    }

    public static function update($data)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('UPDATE pesanan SET tanggal = :tanggal, diskon = :diskon, status_bayar = :status_bayar, anggota_id = :anggota_id WHERE id = :id');
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':tanggal', $data['tanggal']);
        $stmt->bindParam(':diskon', $data['diskon']);
        $stmt->bindParam(':status_bayar', $data['status_bayar']);
        $stmt->bindParam(':anggota_id', $data['anggota_id']);
        return $stmt->execute();
    }

    public static function delete($id)
    {
        $pdo = Connection::make();

        $sqlPembayaran = "DELETE FROM pembayaran WHERE pesanan_id = ?";
        $stmtPembayaran = $pdo->prepare($sqlPembayaran);
        $stmtPembayaran->execute([$id]);

        $sqlDetail = "DELETE FROM detail_pesanan WHERE pesanan_id = ?";
        $stmtDetail = $pdo->prepare($sqlDetail);
        $stmtDetail->execute([$id]);

        $sql = "DELETE FROM pesanan WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
