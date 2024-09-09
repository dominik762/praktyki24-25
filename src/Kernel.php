<?php

namespace App;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use PDO;

class Kernel
{
    private static ?Kernel $instance = null;


    public static function getInstance(): Kernel
    {
        if (self::$instance === null) {
            self::$instance = new Kernel();
        }

        return self::$instance;
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





}
