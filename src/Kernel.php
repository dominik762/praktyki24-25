<?php

namespace App;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

class Kernel
{
    public function __construct()
    {
        $this->initLogger();
    }

    public function initLogger(): void
    {
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../storage/logs/logi.log', Level::Info));
        $log->info('Aplikacja wystartowała');
    }
}