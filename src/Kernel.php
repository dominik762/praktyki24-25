<?php

namespace App;

use App\Controllers\DashboardController;
use App\Controllers\UserManagementController;
use App\Exceptions\UndefinedControllerException;
use Dotenv\Dotenv;

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
            self::initEnv();
        }

        return static::$instance;
    }

    public function run(): void
    {
        View::render('indexView.header', ['title' => 'Your Application Title']);
        try
        {
            $this->router->route($this->availableControllers);
        }
        catch (UndefinedControllerException $e)
        {
            echo 'UndefinedControllerException: ' . $e->getMessage();

        }
        View::render('indexView.footer');
    }
    private static function initEnv():void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->safeload();
    }








}
