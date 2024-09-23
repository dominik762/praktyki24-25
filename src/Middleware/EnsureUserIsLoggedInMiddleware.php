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
        if (empty($_SESSION['userId'])) {
            Redirect::to('authuser.signIn');
        }
    }
}
