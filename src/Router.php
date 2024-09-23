<?php

namespace App;

use App\Exceptions\UndefinedControllerException;
use App\Exceptions\UndefinedRouteException;
use App\Middleware\EnsureUserIsLoggedInMiddleware;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use ReflectionException;
use ReflectionMethod;

class Router
{
    /**
     * @throws UndefinedControllerException
     * @throws ReflectionException
     * @throws UndefinedRouteException
     * @throws FileNotFoundException
     */
    public function route(array $availableControllers): void
    {
        $this->handleMiddlewares();
        if (isset($_GET['controller']) && isset($_GET['do'])) {
            $controller = htmlspecialchars($_GET['controller']);
            $do = htmlspecialchars($_GET['do']);
            $params = $_POST;

            if (isset($availableControllers[$controller])) {
                $className = $availableControllers[$controller];

                if (class_exists($className)) {
                    $class = new $className();

                    $reflection = new ReflectionMethod($class, $do);
                    $requiredParams = $reflection->getParameters();

                    if (method_exists($class, $do)) {
                        if (count($requiredParams) > 0) {
                            $methodParams = [];
                            foreach ($requiredParams as $param) {
                                $paramName = $param->getName();
                                if (isset($params[$paramName])) {
                                    $methodParams[] = $params[$paramName];
                                } else {
                                    throw new UndefinedControllerException("Missing parameter: $paramName");
                                }
                            }
                            $class->{$do}(...$methodParams);

                        } else {
                            $class->{$do}();
                        }
                    }
                }
            } else {
                throw new UndefinedControllerException($controller);
            }
        }
    }

    /**
     * @throws FileNotFoundException
     * @throws UndefinedRouteException
     */
    private function handleMiddlewares(): void
    {
        $url = $_SERVER['REQUEST_URI'];
        $availableRoutes = Urls::getAvailableRoutes();

        foreach ($availableRoutes as $route) {
            if ($route['url'] === $url) {
                $middlewares = $route['middleware'];
                foreach ($middlewares as $middlewareClass) {
                    $middleware = new $middlewareClass();
                    $middleware->handle();
                }
            }
        }
    }

}