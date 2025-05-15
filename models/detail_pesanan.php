<?php

namespace models;

require_once __DIR__ . '/../config/Connection.php';

use config\Connection;
use PDO;

class DetailPesanan
{
    public static function all()
    {
        $pdo = Connection::make();
        $sql = 'SELECT detail_pesanan.*, produk.nama AS nama_produk 
                FROM detail_pesanan 
                LEFT JOIN produk ON detail_pesanan.produk_id = produk.id';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($pesanan_id, $produk_id)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('SELECT * FROM detail_pesanan WHERE pesanan_id = :pid AND produk_id = :prid');
        $stmt->bindParam(':pid', $pesanan_id);
        $stmt->bindParam(':prid', $produk_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('INSERT INTO detail_pesanan (pesanan_id, produk_id, jumlah) 
                               VALUES (:pesanan_id, :produk_id, :jumlah)');
        $stmt->bindParam(':pesanan_id', $data['pesanan_id']);
        $stmt->bindParam(':produk_id', $data['produk_id']);
        $stmt->bindParam(':jumlah', $data['jumlah']);
        return $stmt->execute();
    }

    public static function update($data)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('UPDATE detail_pesanan SET jumlah = :jumlah 
                               WHERE pesanan_id = :pesanan_id AND produk_id = :produk_id');
        $stmt->bindParam(':pesanan_id', $data['pesanan_id']);
        $stmt->bindParam(':produk_id', $data['produk_id']);
        $stmt->bindParam(':jumlah', $data['jumlah']);
        return $stmt->execute();
    }

    public static function delete($pesanan_id, $produk_id)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('DELETE FROM detail_pesanan WHERE pesanan_id = :pid AND produk_id = :prid');
        $stmt->bindParam(':pid', $pesanan_id);
        $stmt->bindParam(':prid', $produk_id);
        return $stmt->execute();
    }
}
