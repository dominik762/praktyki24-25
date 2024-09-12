<?php

use App\Kernel;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../pages/main.php';

$kernel = Kernel::getInstance();

$kernel->run();





