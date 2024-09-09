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
        try
        {
            static::$connection = new PDO('mysql:host=' . $host . ';dbname=' . $databaseName, $user, $pass);
        }
        catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
    public static function getInstance(): PDO
    {
        if (static::$instance === null)
        {
            $database = new self();
            $database->initDatabase();
            Logger::getInstance();
            static::$instance = $database;
            return $database->getConnection();
        }
        return static::$connection;

    }

    private function getConnection():PDO
    {
        return static::$connection;
    }
    private function initDatabase(): void
    {
        $this->initConnection('localhost', 'root', '','witryna1db');

        if (static::getConnection() !== null)
        {
            Logger::getInstance()->info('Połączenie z bazą danych zostało nawiązane');
        } else
        {
            Logger::getInstance()->info('Nie udało się nawiązać połączenia z bazą danych');
        }
    }
}
