<?php

use App\Kernel;
use App\User;

require_once __DIR__ . '/../vendor/autoload.php';

$_GET['id'] = 1;

$kernel = Kernel::getInstance();

$kernel->run();
User::addUser();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formularz rejestracji</title>
</head>
<body>
    <h1>Rejestracja nowego użytkownika</h1>
    <form action="index.php" method="POST">
        <label for="name">Nazwa:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <input type="submit" value="Zarejestruj">
    </form>
</body>
</html>




