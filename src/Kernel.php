<?php

namespace App;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use PDO;

class Kernel
{
    private static ?Kernel $instance = null;
    private Router $router;

    private function __construct()
    {
        $this->router = new Router();
    }

    public static function getInstance(): Kernel
    {
        if (static::$instance === null)
        {
            static::$instance = new Kernel();
        }

        return static::$instance;
    }

    public function run(): void
    {
        $this->router->route();
    }








}
