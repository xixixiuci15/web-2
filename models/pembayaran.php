<?php

namespace models;

require_once __DIR__ . '/../config/Connection.php';

use config\Connection;
use PDO;

class Pembayaran
{
    public static function all()
    {
        $pdo = Connection::make();
        $sql = 'SELECT pembayaran.*, pesanan.tanggal AS tanggal_pesanan 
                FROM pembayaran 
                LEFT JOIN pesanan ON pembayaran.pesanan_id = pesanan.id';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('SELECT * FROM pembayaran WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('INSERT INTO pembayaran (jumlah_bayar, tanggal, pesanan_id) 
                               VALUES (:jumlah_bayar, :tanggal, :pesanan_id)');
        $stmt->bindParam(':jumlah_bayar', $data['jumlah_bayar']);
        $stmt->bindParam(':tanggal', $data['tanggal']);
        $stmt->bindParam(':pesanan_id', $data['pesanan_id']);
        return $stmt->execute();
    }

    public static function update($data)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('UPDATE pembayaran 
                               SET jumlah_bayar = :jumlah_bayar, tanggal = :tanggal, pesanan_id = :pesanan_id 
                               WHERE id = :id');
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':jumlah_bayar', $data['jumlah_bayar']);
        $stmt->bindParam(':tanggal', $data['tanggal']);
        $stmt->bindParam(':pesanan_id', $data['pesanan_id']);
        return $stmt->execute();
    }

    public static function delete($id)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('DELETE FROM pembayaran WHERE id = :id');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
