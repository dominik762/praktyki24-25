<?php

namespace App;

use App\Exceptions\UndefinedRouteException;
use JetBrains\PhpStorm\NoReturn;

class Redirect
{
    /**
     * @throws UndefinedRouteException
     */
    #[NoReturn] public static function to(string $url): void
    {
        header('Location: ' . Urls::pickUrl($url));
        exit();
    }

}