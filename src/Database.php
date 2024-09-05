<?php

namespace App;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private PDO $connection;

    public function initConnection(string $host, string $user, string $pass, string $databaseName): void
    {
        try
        {
            $this->connection = new PDO('mysql:host=' . $host . ';dbname=' . $databaseName, $user, $pass);
        }
        catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection():PDO
    {
        return $this->connection;
    }
}
