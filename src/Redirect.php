<?php

namespace App;

use App\Exceptions\UndefinedRouteException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use JetBrains\PhpStorm\NoReturn;

class Redirect
{
    /**
     * @throws UndefinedRouteException
     * @throws FileNotFoundException
     */
    #[NoReturn] public static function to(string $url): void
    {
        header('Location: ' . Urls::pickUrl($url));
        exit();
    }

}