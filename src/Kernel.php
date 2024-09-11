<?php

namespace App;

use App\Exceptions\UndefinedControllerException;

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
        try
        {
            $this->router->route();
        }
        catch (UndefinedControllerException $e)
        {
            echo $e->getMessage();

        }
    }








}
