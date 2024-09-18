<?php

namespace App;

use App\Controllers\AuthUser;
use App\Controllers\DashboardController;
use App\Controllers\UserManagementController;
use App\Exceptions\AccessException;
use App\Exceptions\UndefinedControllerException;
use Dotenv\Dotenv;
use Illuminate\Filesystem\Filesystem;

class Kernel
{
    private static ?Kernel $instance = null;
    private static ?Filesystem $filesystem = null;
    private Router $router;
    private array $availableControllers = array(
        'dashboard' => DashboardController::class,
        'usermanagement' => UserManagementController::class,
        'authuser' => AuthUser::class,
    );

    private function __construct()
    {
        self::initEnv();
        $this->router = new Router();
        Session::start();
    }

    public static function getInstance(): Kernel
    {
        if (static::$instance === null) {
            static::$instance = new Kernel();
        }

        return static::$instance;
    }

    public static function getFilesystem(): Filesystem
    {
        if (static::$filesystem === null) {
            static::$filesystem = new Filesystem();
        }
        return static::$filesystem;
    }

    public function run(): void
    {
        View::render('indexView.header', ['title' => 'Your Application Title']);
        try {
            $this->router->route($this->availableControllers);
        } catch (UndefinedControllerException $e) {
            echo 'UndefinedControllerException: ' . $e->getMessage();

        }
        View::render('indexView.footer');
    }

    private static function initEnv(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->safeload();
    }


}
