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
    private static ?Logger $logger = null;

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
    public static function getLogger(): Logger
    {
        if (self::$logger === null) {
            self::$logger = self::initLogger();
        }

        return self::$logger;
    }

    public static function initLogger(): Logger
    {
        $log = new Logger('app_logger');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../storage/logs/logi.log', Level::Info));
        $log->info('Aplikacja wystartowała');

        return $log;
    }

    public static function initDatabase(): void
    {
        self::$logger = self::getLogger();
        self::$database = Database::getInstance();
        self::$database->initConnection('localhost', 'root', '','witryna1db');

        if (self::$database->getConnection() !== null)
        {
            self::$logger->info('Połączenie z bazą danych zostało nawiązane');
        } else
        {
            self::$logger->info('Nie udało się nawiązać połączenia z bazą danych');
        }
    }




}
