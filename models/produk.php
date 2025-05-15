<?php
namespace models;

require_once __DIR__ . '/../config/connection.php';

use config\Connection;
use PDO;

class Produk
{
    // Menampilkan semua produk dan nama jenis produk
    public static function all()
    {
        $pdo = Connection::make();
        $sql = 'SELECT produk.*, jenis_produk.nama_jenis_produk 
                FROM produk 
                LEFT JOIN jenis_produk ON produk.id = jenis_produk.id';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menampilkan satu produk berdasarkan ID
    public static function find($id)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('SELECT * FROM produk WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Menambahkan produk baru
    public static function create($data)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('INSERT INTO produk (nama, jenis_id, harga, stok) 
                               VALUES (:nama, :jenis_id, :harga, :stok)');
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':jenis_id', $data['jenis_id']);
        $stmt->bindParam(':harga', $data['harga']);
        $stmt->bindParam(':stok', $data['stok']);
        return $stmt->execute();
    }

    // Mengubah data produk
    public static function update($data)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('UPDATE produk 
                               SET nama = :nama, jenis_id = :jenis_id, harga = :harga, stok = :stok 
                               WHERE id = :id');
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':jenis_id', $data['jenis_id']);
        $stmt->bindParam(':harga', $data['harga']);
        $stmt->bindParam(':stok', $data['stok']);
        return $stmt->execute();
    }

    // Menghapus produk berdasarkan ID
    public static function delete($id)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('DELETE FROM produk WHERE id = :id');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
