<?php

use App\Kernel;
use App\User;

require_once __DIR__ . '/../vendor/autoload.php';

$kernel = Kernel::getInstance();

$PDO = Kernel::getDatabase();
$user1 = User::find(1);
if (isset($user1)) echo $user1->getName();