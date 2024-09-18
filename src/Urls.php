<?php

namespace App;

use App\Exceptions\UndefinedRouteException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class Urls
{
    private Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @throws FileNotFoundException
     */
    private function loadUrls(): array
    {
        $directory = '../routes';

        $finder = new Finder();
        $finder->files()->in($directory)->name('*.php');

        $availableRoutes = [];

        foreach ($finder as $file) {
            $filePath = $file->getRealPath();
            if ($this->filesystem->exists($filePath)) {
                $routes = $this->filesystem->getRequire($filePath);
                $availableRoutes = array_merge($availableRoutes, $routes);
            }
        }

        return $availableRoutes;
    }

    /**
     * @throws FileNotFoundException
     * @throws UndefinedRouteException
     */
    public static function pickUrl(string $routeKey): string
    {
        $filesystem = Kernel::getFilesystem();
        $urls = new Urls($filesystem);

        $availableRoutes = $urls->loadUrls();
        if (array_key_exists($routeKey, $availableRoutes)) {
            return $availableRoutes[$routeKey];
        }

        throw new UndefinedRouteException("Nie znaleziono: " . $routeKey . "!");
    }
}
