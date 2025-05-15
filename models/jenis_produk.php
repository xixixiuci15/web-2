<?php

namespace models;

require_once __DIR__ . '/../config/connection.php';

use config\Connection;
use PDO;

class JenisProduk
{
    public static function all()
    {
        $pdo = Connection::make();
        $stmt = $pdo->query('SELECT * FROM jenis_produk');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('SELECT * FROM jenis_produk WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('INSERT INTO jenis_produk (nama_jenis_produk, deskripsi) VALUES (:nama, :deskripsi)');
        $stmt->bindParam(':nama', $data['nama_jenis_produk']);
        $stmt->bindParam(':deskripsi', $data['deskripsi']);
        return $stmt->execute();
    }

    public static function update($data)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('UPDATE jenis_produk SET nama = :nama, deskripsi = :deskripsi WHERE id = :id');
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':deskripsi', $data['deskripsi']);
        return $stmt->execute();
    }

    public static function delete($id)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('DELETE FROM jenis_produk WHERE id = :id');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
