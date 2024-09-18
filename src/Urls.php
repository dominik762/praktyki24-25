<?php

namespace App;

use App\Exceptions\UndefinedRouteException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;

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
        $files = [
            '../routes/auth.php',
            '../routes/dashboard.php',
            '../routes/usermanagement.php',
        ];

        $availableRoutes = [];

        foreach ($files as $file) {
            if ($this->filesystem->exists($file)) {
                $routes = $this->filesystem->getRequire($file);
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
