<?php

namespace App;

use App\Exceptions\UndefinedControllerException;
use App\Exceptions\UndefinedRouteException;

class Router
{
    /**
     * @throws UndefinedControllerException
     * @throws \ReflectionException
     * @throws UndefinedRouteException
     */
    public function route(array $availableControllers): void
    {
        Session::checkAccess();
        if (isset($_GET['controller']) && isset($_GET['do'])) {
            $controller = htmlspecialchars($_GET['controller']);
            $do = htmlspecialchars($_GET['do']);
            $params = $_POST;

            if (isset($availableControllers[$controller])) {
                $className = $availableControllers[$controller];

                if (class_exists($className)) {
                    $class = new $className();

                    $reflection = new \ReflectionMethod($class, $do);
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
}