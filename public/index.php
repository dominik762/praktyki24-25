<?php

use App\Database;
use App\Kernel;
use App\User;
use App\Exceptions\UndefinedControllerException;

require_once __DIR__ . '/../vendor/autoload.php';

$kernel = Kernel::getInstance();
try
{
    $kernel->run();
}
catch (UndefinedControllerException $e)
{
    echo 'Connection failed: ' . $e->getMessage();
}



