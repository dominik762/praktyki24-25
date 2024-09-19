<?php

use App\AppMode;
use App\Kernel;

require_once __DIR__ . '/../vendor/autoload.php';

$kernel = Kernel::getInstance();

$kernel->run();

AppMode::setAppMode($_ENV['APP_ENV']);

//throw new \App\Exceptions\UndefinedControllerException("wyjatek");





