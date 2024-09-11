<?php

namespace App\Controllers;

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

}