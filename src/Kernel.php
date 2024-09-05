<?php

namespace App;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

class Kernel
{
    public $database;

    public function __construct(Database $database)
    {

        $this->database = $database;
        $this->initLogger();
        $this->initDatabase();
    }

    public function initLogger(): void
    {
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../storage/logs/logi.log', Level::Info));
        $log->info('Aplikacja wystartowała');
    }

    public function initDatabase(): void
    {
        $connection = $this->database->getConnection();

        if ($connection) {
            echo "Połączenie z bazą danych zostało nawiązane";
        } else {
            echo "Nie udało się nawiązać połączenia z bazą danych";
        }
    }
}
