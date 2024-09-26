<?php

namespace App\Controllers;

use App\Database;
use App\Redirect;
use App\User;
use App\View;
use PDO;

class UserManagementController
{
    public function show(int $id): void
    {
        $user = User::find($id);
        if ($user) {
            View::render('UserManagement.show', ['user' => $user,
                'absolute_url'=>$_ENV['APP_ABSOLUTE_URL'],
                ]);
        } else {
            View::render('UserManagement.show', ['error' => "Użytkownik o ID $id nie został znaleziony",
                'absolute_url'=>$_ENV['APP_ABSOLUTE_URL'],
                ]);
        }
    }

    public function create(): void
    {
        View::render('UserManagement..AuthUser.register',[
            'absolute_url'=>$_ENV['APP_ABSOLUTE_URL'],
        ]);
    }

    public static function showAll(): void
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM users";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        View::render('UserManagement.list', ['users' => $users,
            'absolute_url'=>$_ENV['APP_ABSOLUTE_URL'],]);
    }

    public function delete(int $id): void
    {
        $user = User::find($id);
        if ($user) {
            $db = Database::getInstance();
            $sql = "DELETE FROM users WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$id]);
            Redirect::to('usermanagement.showAll');
        } else {
            View::render('UserManagement.list', ['error' => "Użytkownik o ID $id nie został znaleziony.",
                'absolute_url'=>$_ENV['APP_ABSOLUTE_URL'],]);
        }
    }

    public function edit(int $id): void
    {
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
            $db = Database::getInstance();
            $sql = "UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$_POST['name'], $_POST['email'], $_POST['password'], $id]);
        }
    }

    public function editForm(int $id): void
    {
        $user = User::find($id);
        if ($user) {
            View::render('UserManagement.editForm', ['user' => $user,
                'absolute_url'=>$_ENV['APP_ABSOLUTE_URL'],]);
        } else {
            View::render('UserManagement.show', ['error' => "Użytkownik o ID $id nie został znaleziony",
                'absolute_url'=>$_ENV['APP_ABSOLUTE_URL'],]);
        }
    }
}
