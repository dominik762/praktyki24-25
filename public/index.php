<?php

use App\Kernel;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../secured/');
$dotenv->load();

$kernel = Kernel::getInstance();

$kernel->run();





