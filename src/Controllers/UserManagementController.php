<?php

namespace App\Controllers;

use App\User;

class UserManagementController
{
    public function index()
    {
        echo "Lista użytkowników";
    }

    public static function show(int $id)
    {
        $user = User::find($id);
        if ($user) {
            echo "Nazwa użytkownika: " . $user->getName() . "<br>";
        } else {
            echo "Użytkownik o ID $id nie został znaleziony<br>";
        }
    }

}