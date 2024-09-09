<?php

use App\Database;
use App\Kernel;
use App\User;

require_once __DIR__ . '/../vendor/autoload.php';

$kernel = Kernel::getInstance();

$user1 = User::find(1);
if (isset($user1)) echo $user1->getName();