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
        try
        {
            $this->router->route($this->availableControllers);
        }
        catch (UndefinedControllerException $e)
        {
            echo 'UndefinedControllerException: ' . $e->getMessage();

        }
    }








}
