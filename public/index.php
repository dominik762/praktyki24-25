<?php

use App\Database;
use App\Kernel;

require_once __DIR__ . '/../vendor/autoload.php';

$database = Database::getInstance('witryna1db');

$kernel = Kernel::getInstance($database);









?>