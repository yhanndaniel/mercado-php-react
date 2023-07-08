<?php

namespace App\Connection;

use PDO;
use PDOException;

final class DatabaseConnection
{
    public static function open(): PDO
    {
        $databaseHost = $_ENV['DATABASE_HOST'] ?? '127.0.0.1';
        $databaseName = $_ENV['DATABASE_NAME'] ?? 'db_estacio_library';
        $databaseUser = $_ENV['DATABASE_USER'] ?? 'root';
        $databasePassword = $_ENV['DATABASE_PASSWORD'] ?? 'root';
        
        $dsn = "mysql:host={$databaseHost};dbname={$databaseName}";

        try {
            $connection = new PDO($dsn, $databaseUser, $databasePassword);
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
