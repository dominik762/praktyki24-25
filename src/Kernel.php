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
        if (static::$instance === null)
        {
            static::$instance = new Kernel();
        }

        return static::$instance;
    }








}
