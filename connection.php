<?php
require_once 'config.php';
class Connection
{
    public static function make()
    {
        require_once __DIR__ . '/../config.php';
        $host = $GLOBALS['host'] ?? 'localhost';
        $db = $GLOBALS['db'] ?? 'dbkoperasii';
        $user = $GLOBALS['user'] ?? 'root';
        $password = $GLOBALS['password'] ?? '';

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
        try {
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            return new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
return Connection::make();
