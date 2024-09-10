<?php

namespace App;

use App\Controllers\DashboardController;
use App\Controllers\UserManagementController;

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
                    echo "Nieznany kontroler";
                    break;
            }
        } else {
            echo "Brak parametrów w URL";
        }
    }
}