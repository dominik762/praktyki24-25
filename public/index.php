<?php

use App\Kernel;

require_once __DIR__ . '/../vendor/autoload.php';

$kernel = Kernel::getInstance();

$PDO = Kernel::getDatabase();

$User1 = Kernel::getUser();


?>