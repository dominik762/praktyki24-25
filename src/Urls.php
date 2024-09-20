<?php

namespace App;

use App\Exceptions\UndefinedRouteException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class Urls
{
    private Filesystem $filesystem;
    private array $availableRoutes=[];

    public function __construct()
    {
        $this->filesystem = new Filesystem();
    }

    /**
     * @throws FileNotFoundException
     */
    public function loadUrls(): array
    {
        $directory = '../routes';

        $finder = new Finder();
        $finder->files()->in($directory)->name('*.php');

        $availableRoutes = $this->getAvailableRoutes();

        foreach ($finder as $file) {
            $filePath = $file->getRealPath();
            if ($this->filesystem->exists($filePath)) {
                $routes = $this->filesystem->getRequire($filePath);
                if (is_array($routes)) {
                    $availableRoutes = array_merge($availableRoutes, $routes);
                }
            }
        }

        return $availableRoutes;
    }

    public function getAvailableRoutes(): array
    {
        return $this->availableRoutes;
    }

    /**
     * @throws FileNotFoundException
     * @throws UndefinedRouteException
     */
    public function pickUrl(string $routeKey): string
    {
        $availableRoutes = $this->loadUrls();

        if (array_key_exists($routeKey, $availableRoutes)) {
            return $availableRoutes[$routeKey]['url'];
        }

        throw new UndefinedRouteException("Route not found: " . $routeKey . "!");
    }
}
