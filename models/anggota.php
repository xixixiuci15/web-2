<?php

namespace models;

require_once __DIR__ . '/../config/Connection.php';

use config\Connection;
use PDO;

class Anggota
{
    public static function all()
    {
        $pdo = Connection::make();
        $sql = 'SELECT anggota.*, 
       pegawai.nama AS nama_pegawai, 
       pegawai.jabatan, 
       pegawai.jenis_kelamin,
       kartu_diskon.nama AS nama_diskon,
       kartu_diskon.persen_diskon

                FROM anggota
                LEFT JOIN pegawai ON anggota.pegawai_id = pegawai.id
                LEFT JOIN kartu_diskon ON anggota.kartu_diskon_id = kartu_diskon.id';
        $statement = $pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $pdo = Connection::make();
        $sql = 'SELECT anggota.*, 
                       pegawai.nama AS nama_pegawai, 
                       pegawai.jabatan, 
                       pegawai.jenis_kelamin,
                       kartu_diskon.nama AS nama_diskon
                FROM anggota
                LEFT JOIN pegawai ON anggota.pegawai_id = pegawai.id
                LEFT JOIN kartu_diskon ON anggota.kartu_diskon_id = kartu_diskon.id
                WHERE anggota.id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        try {
            $pdo = Connection::make();

            $sqlCheck = 'SELECT COUNT(*) FROM kartu_diskon WHERE id = :kartu_diskon_id';
            $stmtCheck = $pdo->prepare($sqlCheck);
            $stmtCheck->bindParam(':kartu_diskon_id', $data['kartu_diskon_id'], PDO::PARAM_INT);
            $stmtCheck->execute();
            $validKartuDiskon = $stmtCheck->fetchColumn();

            if ($validKartuDiskon == 0) {
                throw new \Exception("Kartu Diskon ID tidak valid.");
            }

            $sqlCheckPegawai = 'SELECT COUNT(*) FROM pegawai WHERE id = :pegawai_id';
            $stmtCheckPegawai = $pdo->prepare($sqlCheckPegawai);
            $stmtCheckPegawai->bindParam(':pegawai_id', $data['pegawai_id'], PDO::PARAM_INT);
            $stmtCheckPegawai->execute();
            $validPegawai = $stmtCheckPegawai->fetchColumn();

            if ($validPegawai == 0) {
                throw new \Exception("Pegawai ID tidak valid.");
            }

            $sql = 'INSERT INTO anggota (status_aktif, pegawai_id, kartu_diskon_id)
                    VALUES (:status_aktif, :pegawai_id, :kartu_diskon_id)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':status_aktif', $data['status_aktif'], PDO::PARAM_BOOL);
            $stmt->bindParam(':pegawai_id', $data['pegawai_id'], PDO::PARAM_INT);
            $stmt->bindParam(':kartu_diskon_id', $data['kartu_diskon_id'], PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\Exception $e) {

            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public static function update($data)
    {
        try {
            $pdo = Connection::make();

            $sqlCheck = 'SELECT COUNT(*) FROM kartu_diskon WHERE id = :kartu_diskon_id';
            $stmtCheck = $pdo->prepare($sqlCheck);
            $stmtCheck->bindParam(':kartu_diskon_id', $data['kartu_diskon_id'], PDO::PARAM_INT);
            $stmtCheck->execute();
            $validKartuDiskon = $stmtCheck->fetchColumn();

            if ($validKartuDiskon == 0) {
                throw new \Exception("Kartu Diskon ID tidak valid.");
            }

            $sqlCheckPegawai = 'SELECT COUNT(*) FROM pegawai WHERE id = :pegawai_id';
            $stmtCheckPegawai = $pdo->prepare($sqlCheckPegawai);
            $stmtCheckPegawai->bindParam(':pegawai_id', $data['pegawai_id'], PDO::PARAM_INT);
            $stmtCheckPegawai->execute();
            $validPegawai = $stmtCheckPegawai->fetchColumn();

            if ($validPegawai == 0) {
                throw new \Exception("Pegawai ID tidak valid.");
            }

            $sql = 'UPDATE anggota
                    SET status_aktif = :status_aktif,
                        pegawai_id = :pegawai_id,
                        kartu_diskon_id = :kartu_diskon_id
                    WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
            $stmt->bindParam(':status_aktif', $data['status_aktif'], PDO::PARAM_BOOL);
            $stmt->bindParam(':pegawai_id', $data['pegawai_id'], PDO::PARAM_INT);
            $stmt->bindParam(':kartu_diskon_id', $data['kartu_diskon_id'], PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public static function delete($id)
    {
        $pdo = Connection::make();

        $stmt = $pdo->prepare("DELETE dp FROM detail_pesanan dp
                           JOIN pesanan p ON dp.pesanan_id = p.id
                           WHERE p.anggota_id = ?");
        $stmt->execute([$id]);

        $stmt = $pdo->prepare("DELETE FROM pesanan WHERE anggota_id = ?");
        $stmt->execute([$id]);

        $stmt = $pdo->prepare("DELETE FROM anggota WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
