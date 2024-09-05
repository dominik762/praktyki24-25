<?php

namespace App;

use PDO;
use PDOException;

class Database
{
    public $connection;

    public function __construct($database)
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

    public function getConnection()
    {
        return $this->connection;
    }
}
