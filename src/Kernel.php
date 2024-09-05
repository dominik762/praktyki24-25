<?php

namespace App;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use PDO;

class Kernel
{
    private static ?Kernel $instance = null;
    private static ?Database $database = null;

    private function __construct()
    {
        $this->initLogger();
//        $this->initDatabase();
    }

    public static function getInstance(): Kernel
    {
        if (self::$instance === null) {
            self::$instance = new Kernel();
        }

        return self::$instance;
    }

    public static function getDatabase(): PDO
    {
        if (self::$database === null) {
           self::initDatabase();
        }

        return self::$database->getConnection();
    }

    public function initLogger(): void
    {
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../storage/logs/logi.log', Level::Info));
        $log->info('Aplikacja wystartowała');

    }

    public static function initDatabase(): void
    {
        $logger = self::getLogger();
        self::$database = Database::getInstance();
        self::$database->initConnection('localhost', 'root', '','witryna1db');
//        $connection =self::$database->getConnection();
//
//        if ($connection) {
//            echo "Połączenie z bazą danych zostało nawiązane";
//        } else {
//            echo "Nie udało się nawiązać połączenia z bazą danych";
//        }
    }

    private static function getLogger()
    {
    }

}
