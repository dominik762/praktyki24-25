<?php

namespace App;

use App\Exceptions\UndefinedRouteException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class Urls
{
    private Filesystem $filesystem;
    private static array $availableRoutes = [];
    private static ?Urls $instance = null;

    private function __construct()
    {
        $this->filesystem = new Filesystem();
        $this->loadUrls();
    }

    public static function getInstance(): Urls
    {
        if (static::$instance == null) {
            static::$instance = new Urls();
        }
        return static::$instance;
    }

    /**
     * @throws FileNotFoundException
     */
    private function loadUrls(): void
    {
        $directory = '../routes';

        $finder = new Finder();
        $finder->files()->in($directory)->name('*.php');

        $availableRoutes = static::$availableRoutes;

        foreach ($finder as $file) {
            $filePath = $file->getRealPath();
            if ($this->filesystem->exists($filePath)) {
                $routes = $this->filesystem->getRequire($filePath);
                if (is_array($routes)) {
                    $availableRoutes = array_merge($availableRoutes, $routes);
                }
            }
        }

        static::$availableRoutes = $availableRoutes;
    }

    public static function getAvailableRoutes(): array
    {
        $Urls = self::getInstance();
        return $Urls::$availableRoutes;
    }

    /**
     * @throws FileNotFoundException
     * @throws UndefinedRouteException
     */
    public static function pickUrl(string $routeKey): string
    {
        $Urls = self::getInstance();
        $availableRoutes = $Urls::$availableRoutes;

        if (array_key_exists($routeKey, $availableRoutes)) {
            return $availableRoutes[$routeKey]['url'];
        }

        throw new UndefinedRouteException("Route not found: " . $routeKey . "!");
    }
}
