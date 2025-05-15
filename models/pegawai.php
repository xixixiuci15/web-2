<?php

namespace models;

require_once __DIR__ . '/../config/connection.php';

use config\Connection;
use PDO;

class Pegawai
{
    public static function all()
    {
        $pdo = Connection::make();
        $stmt = $pdo->query('SELECT * FROM pegawai');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('SELECT * FROM pegawai WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('INSERT INTO pegawai (nip, nama, jenis_kelamin, jabatan) VALUES (:nip, :nama, :jk, :jabatan)');
        $stmt->execute([
            'nip' => $data['nip'],
            'nama' => $data['nama'],
            'jk' => $data['jenis_kelamin'],
            'jabatan' => $data['jabatan']
        ]);
        return $pdo->lastInsertId();
    }

    public static function update($id, $data)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('UPDATE pegawai SET nip = :nip, nama = :nama, jenis_kelamin = :jk, jabatan = :jabatan WHERE id = :id');
        return $stmt->execute([
            'nip' => $data['nip'],
            'nama' => $data['nama'],
            'jk' => $data['jenis_kelamin'],
            'jabatan' => $data['jabatan'],
            'id' => $id
        ]);
    }

    public static function delete($id)
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare('DELETE FROM pegawai WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
