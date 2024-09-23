<?php

namespace App\Controllers;

use App\Database;
use App\User;
use App\View;
use PDO;

class UserManagementController
{
    public function show(int $id): void
    {
        $user = User::find($id);
        if ($user) {
            View::render('UserManagement.show', ['user' => $user]);
        } else {
            View::render('UserManagement.show', ['error' => "Użytkownik o ID $id nie został znaleziony"]);
        }
    }

    public function create(): void
    {
        View::render('UserManagement..AuthUserController.register');
    }

    public static function showAll(): void
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM users";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        View::render('UserManagement.list', ['users' => $users]);
    }

    public function delete(int $id): void
    {
        $user = User::find($id);
        if ($user) {
            $db = Database::getInstance();
            $sql = "DELETE FROM users WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$id]);
            View::render('UserManagement.show', ['message' => "Użytkownik o ID $id został usunięty."]);
        } else {
            View::render('UserManagement.show', ['error' => "Użytkownik o ID $id nie został znaleziony."]);
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
            View::render('UserManagement.editForm', ['user' => $user]);
        } else {
            View::render('UserManagement.show', ['error' => "Użytkownik o ID $id nie został znaleziony"]);
        }
    }
}
