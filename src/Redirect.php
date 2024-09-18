<?php

namespace App;

use App\Exceptions\UndefinedRouteException;

class Redirect
{
    private static function loadUrls(): array
    {
        $files = array(
            '../routes/auth.php',
            '../routes/dashboard.php',
            '../routes/usermanagement.php',
        );

        $availableRoutes = [];
        foreach ($files as $file) {
            $file = include_once $file;
            $availableRoutes = array_merge($availableRoutes, $file);
        }
        return $availableRoutes;
    }

    public static function pickUrl(string $routeKey): string
    {
        $availableRoutes = self::loadUrls();
        if (array_key_exists($routeKey, $availableRoutes)) {
            return $availableRoutes[$routeKey];
        }
        throw new UndefinedRouteException("Nie znaleziono: " . $routeKey . "!");
    }


    /**
     * @throws UndefinedRouteException
     */
    public static function to(string $url): void
    {
        header('Location: ' . self::pickUrl($url));
        exit();
    }

}