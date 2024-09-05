<?php

use App\Database;
use App\Kernel;

require_once __DIR__ . '/../vendor/autoload.php';

$database = new Database('witryna1db');

$kernel = new Kernel($database);








?>