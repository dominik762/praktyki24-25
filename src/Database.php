<?php

namespace App;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private $connection;
    private $database;

    private function __construct($database)
    {
        $this->database = $database;
        $this->initConnection();
    }

    public function initConnection(): void
    {
        $user = 'root';
        $pass = '';
        try
        {
            $this->connection = new PDO('mysql:host=localhost;dbname=' . $this->database, $user, $pass);
        }
        catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
    public static function getInstance($database = 'witryna1db'): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database($database);
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
