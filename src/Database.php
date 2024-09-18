<?php

namespace App;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private static PDO $connection;

    private function initConnection(string $host, string $user, string $pass, string $databaseName): void
    {
        try {
            static::$connection = new PDO('mysql:host=' . $host . ';dbname=' . $databaseName, $user, $pass);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getInstance(): PDO
    {
        if (static::$instance === null) {
            $database = new self();
            $database->initDatabase();
            Logger::getInstance();
            static::$instance = $database;
            return $database->getConnection();
        }
        return static::$connection;

    }

    private function getConnection(): PDO
    {
        return static::$connection;
    }

    private function initDatabase(): void
    {
        $host = $_ENV['DB_HOST'];
        $database = $_ENV['DB_DATABASE'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $this->initConnection($host, $username, $password, $database);

        if (static::getConnection() !== null) {
            Logger::getInstance()->info('Połączenie z bazą danych zostało nawiązane');
        } else {
            Logger::getInstance()->info('Nie udało się nawiązać połączenia z bazą danych');
        }
    }
}
