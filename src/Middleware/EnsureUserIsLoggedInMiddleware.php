<?php

namespace App\Middleware;

use App\Exceptions\UndefinedRouteException;
use App\Interfaces\MiddlewareInterface;
use App\Redirect;
use App\Urls;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class EnsureUserIsLoggedInMiddleware implements MiddlewareInterface
{
    /**
     * @throws FileNotFoundException
     * @throws UndefinedRouteException
     */
    public function handle(): void
    {
        $availableRoutes = new Urls();
        $availableRoutes->loadUrls();

        $routeKey = ($_GET['controller'] . '.' . $_GET['do']);

        if (array_key_exists($routeKey, (array)$availableRoutes)) {
            $route = $availableRoutes[$routeKey];

            if (in_array('true', $route['middleware'])) {
                if (empty($_SESSION['userId'])) {
                    Redirect::to('authuser.signIn');
                }
            }
        }
    }
}
