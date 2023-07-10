<?php

namespace App\Database;

use PDO;
use PDOException;

final class DatabaseConnection
{
    public static function open(): PDO
    {
        $databaseHost = $_ENV['DATABASE_HOST'] ?? '127.0.0.1';
        $databasePort = $_ENV['DATABASE_PORT'] ?? '5432';
        $databaseName = $_ENV['DATABASE_NAME'] ?? 'mercado_php';
        $databaseUser = $_ENV['DATABASE_USER'] ?? 'postgres';
        $databasePassword = $_ENV['DATABASE_PASSWORD'] ?? 'postgres';
        
        $dsn = "pgsql:host={$databaseHost};port={$databasePort};dbname={$databaseName}";

        try {
            $connection = new PDO($dsn,$databaseUser,$databasePassword,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (PDOException $exception) {
            die('Connection error: '.$exception->getMessage());
        }

        return $connection;
    }

    public static function close(PDO $connection): void
    {
        $connection = null;
    }
}
