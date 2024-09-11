<?php

use App\Kernel;

require_once __DIR__ . '/../vendor/autoload.php';

$_GET['id'] = 1;

$kernel = Kernel::getInstance();

$kernel->run();




