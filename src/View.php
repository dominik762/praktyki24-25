<?php

namespace App;

use Jenssegers\Blade\Blade;
class View
{
    private static $instance = null;

    public static function getInstance(): Blade
    {
        if (self::$instance === null) {
            self::$instance = new Blade(__DIR__ . '/Views', __DIR__ . '/../storage/cache');
        }

        return self::$instance;
    }
    public static function render($view, $data = []):void
    {
        echo self::getInstance()->render($view, $data);
    }

}