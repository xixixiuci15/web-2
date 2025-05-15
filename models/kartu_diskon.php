<?php

namespace models;

require_once __DIR__ . '/../config/connection.php';

use config\Connection;
use PDO;

class KartuDiskon
{
    public static function all()
    {
        $pdo = Connection::make();
        $stmt = $pdo->query('SELECT * FROM kartu_diskon');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('SELECT * FROM kartu_diskon WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('INSERT INTO kartu_diskon (nama, persen_diskon, deskripsi) VALUES (:nama, :persen_diskon, :deskripsi)');
        $stmt->execute([
            'nama' => $data['nama'],
            'persen_diskon' => $data['persen_diskon'],
            'deskripsi' => $data['deskripsi']
        ]);
        return $pdo->lastInsertId();
    }

    public static function update($id, $data)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('UPDATE kartu_diskon SET nama = :nama, persen_diskon = :persen_diskon, deskripsi = :deskripsi WHERE id = :id');
        return $stmt->execute([
            'nama' => $data['nama'],
            'persen_diskon' => $data['persen_diskon'],
            'deskripsi' => $data['deskripsi'],
            'id' => $id
        ]);
    }

    public static function delete($id)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('DELETE FROM kartu_diskon WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
