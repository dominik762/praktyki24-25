<?php

namespace App\Controllers;

use App\Database;
use App\User;

class UserManagementController
{
    public function show(int $id):void
    {
        $user = User::find($id);
        if ($user) {
            echo "Nazwa użytkownika: " . $user->getName() . "<br>";
        } else {
            echo "Użytkownik o ID $id nie został znaleziony<br>";
        }
    }

    public function create():void
    {
        echo '
            <h1>Rejestracja nowego użytkownika</h1>
            <form action="http://localhost/praktyki24-25/public/index.php?controller=usermanagement&do=store" method="POST">
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
            </form>';
    }
    public function store(): void
    {

        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
            $db = Database::getInstance();
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $sql = "Insert into users (id,name, email, password) values (null,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$name, $email, $password]);
        }
    }

}