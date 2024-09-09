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
        if (self::$instance === null)
        {
            self::$instance = new Kernel();
        }

        return self::$instance;
    }








}
