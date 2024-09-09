<?php

namespace App;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger as MonologLogger;

class Logger
{
//    private static ?Logger $instance = null;
    private static ?MonologLogger $logger = null;


//    public static function getInstance(): MonologLogger
//    {
//        if (static::$instance === null)
//        {
//            static::getLogger();
//
//        }
//
//        return static::getLogger();
//    }

    public static function getLogger(): MonologLogger
    {
        if (static::$logger === null)
        {
            static::$logger = static::initLogger();
        }

        return static::$logger;
    }

    private static function initLogger(): MonologLogger
    {
        $log = new MonologLogger( 'app_logger');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../storage/logs/logi.log', Level::Info));
        $log->info('Aplikacja wystartowała');

        return $log;
    }

}