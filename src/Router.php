<?php

namespace App;

use App\Controllers\DashboardController;
use App\Controllers\UserManagementController;
use App\Exceptions\UndefinedControllerException;

class Router
{
    public function route(): void
    {
        if (isset($_GET['controller']) && isset($_GET['do'])) {
            $controller = htmlspecialchars($_GET['controller']);
            $action = htmlspecialchars($_GET['do']);

            switch ($controller) {
                case 'dashboard':
                    if ($action === 'show') {
                        DashboardController::show();
                    }
                    break;

                case 'usermanagement':
                    if ($action === 'show') {
                        UserManagementController::show(1);
                    }
                    break;

                default:
                    if(isset($_POST['msg']))
                    {
                        $msg = $_POST['msg'];
                        throw new UndefinedControllerException($msg);
                    }
            }
        } else {
            DashboardController::show();
        }
    }
}