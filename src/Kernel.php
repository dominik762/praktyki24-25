<?php

namespace App;

use App\Controllers\AuthUserController;
use App\Controllers\DashboardController;
use App\Controllers\UserManagementController;
use App\ErrorHandlers\DevErrorHandler;
use App\ErrorHandlers\ProdErrorHandler;
use App\Exceptions\UndefinedAppModeException;
use App\Exceptions\UndefinedControllerException;
use Dotenv\Dotenv;

class Kernel
{
    private static ?Kernel $instance = null;
    private Router $router;
    private Session $session;
    private array $availableControllers = array(
        'dashboard' => DashboardController::class,
        'usermanagement' => UserManagementController::class,
        'authuser' => AuthUserController::class,
    );

    /**
     * @throws UndefinedAppModeException
     */
    private function __construct()
    {
        $this->initEnv();
        $this->router = new Router();
        $this->session = new Session();
        $this->initMode();
    }

    public static function getInstance(): Kernel
    {
        if (static::$instance === null) {
            static::$instance = new Kernel();
        }

        return static::$instance;
    }

    public function run(): void
    {
        $this->session->start();
        View::render('indexView.header', [
            'title' => 'Your Application Title',
            'absoulte_url' => $_ENV['APP_ABSOLUTE_URL'],
        ]);
        try {
            $this->router->route($this->availableControllers);
        } catch (UndefinedControllerException $e) {
            echo 'UndefinedControllerException: ' . $e->getMessage();

        }
        View::render('indexView.footer');
    }

    private function initEnv(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->safeload();
    }

    private function initMode(): void
    {
        if ($_ENV['APP_ENV'] === 'prod') {
            $displayErrorValue = 0;
            $errorHandler = new ProdErrorHandler();
        } else if ($_ENV['APP_ENV'] === 'dev') {
            $displayErrorValue = 1;
            $errorHandler = new DevErrorHandler();
        } else {
            throw new UndefinedAppModeException("Nieznany tryb obsługi błędów");
        }

        set_error_handler([$errorHandler, 'errorHandler']);
        set_exception_handler([$errorHandler, 'exceptionHandler']);
        register_shutdown_function([$errorHandler, 'shutdownHandler']);

        ini_set('display_errors', $displayErrorValue);
        ini_set('display_startup_errors', $displayErrorValue);
        error_reporting($displayErrorValue ? E_ALL : 0);
    }
}
