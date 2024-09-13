<?php

namespace App;

use App\Controllers\DashboardController;
use App\Controllers\UserManagementController;
use App\Exceptions\UndefinedControllerException;

class Kernel
{
    private static ?Kernel $instance = null;
    private Router $router;
    private array $availableControllers = array(
        'dashboard'=>DashboardController::class,
        'usermanagement'=>UserManagementController::class,
    );

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
        echo"
            <!DOCTYPE html>
            <html lang='pl'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='stylesheet' href='styles/styles-index.css'>
            </head>
            <body>
";
        try
        {
            $this->router->route($this->availableControllers);
        }
        catch (UndefinedControllerException $e)
        {
            echo 'UndefinedControllerException: ' . $e->getMessage();

        }
        echo "
        </body>
        </html>
        ";
    }








}
