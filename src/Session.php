<?php

namespace App;

use App\Exceptions\AccessException;
use App\Exceptions\UndefinedRouteException;

class Session
{
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }

    /**
     * @throws UndefinedRouteException
     */
    public static function checkAccess(): void
    {
        $currentRoute = $_GET['controller'] . '.' . $_GET['do']; // Przykładowo
        if (!isset($_SESSION['userId']) && $currentRoute !== 'authuser.signIn') {
            if($currentRoute !== 'authuser.login') {
                Redirect::to('authuser.signIn');
            }
        }
    }
}