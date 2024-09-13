<?php

namespace App\Controllers;

use App\Database;
use App\User;
use PDO;

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
            <form action="/praktyki24-25/public/index.php?controller=usermanagement&do=store" method="POST">
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
    public static function showAll(): void
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM users";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        echo "<form action='/praktyki24-25/public/index.php?controller=usermanagement&do=create' method='POST'>";
        echo "<input type='submit' value='Dodaj użytkownika'>";
        echo "</form>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<br>";
            echo "<div>";
            echo "<a>";
            echo "<span>" . htmlspecialchars($row['id']) . "</span>";
            echo "<span>" . htmlspecialchars($row['name']) . "</span>";
            echo "<span>" . htmlspecialchars($row['email']) . "</span>";
            echo "<span>" . htmlspecialchars($row['password']) . "</span>";
            echo "</a>";
            echo "</div>";

            // Formularz usuwania użytkownika (POST tylko dla ID, controller i do przez GET)
            echo "<form action='/praktyki24-25/public/index.php?controller=usermanagement&do=delete' method='POST'>";
            echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
            echo "<input type='submit' value='Usuń {$row['name']}'>";
            echo "</form>";

            // Formularz edycji użytkownika (POST tylko dla ID, controller i do przez GET)
            echo "<form action='/praktyki24-25/public/index.php?controller=usermanagement&do=editForm' method='POST'>";
            echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
            echo "<input type='submit' value='Edytuj {$row['name']}'>";
            echo "</form>";
        }
    }

    public function delete(int $id):void
    {
        $user = User::find($id);

        if ($user) {
            $db = Database::getInstance();
            $sql = "DELETE FROM users WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$id]);
            echo "Użytkownik o ID $id został usunięty.<br>";
        } else {
            echo "Użytkownik o ID $id nie został znaleziony.<br>";
        }
    }
    public function edit(int $id):void{
        $user = User::find($id);

        if ($user) {
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
            $db = Database::getInstance();
            $sql = "SELECT * FROM users WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $name = $row['name'];
            $email = $row['email'];
            $password = $row['password'];
            echo "id: " . $id . " imię: " . $name . " email: " . $email . " Hasło: " . $password . "<br>";

            // Formularz edycji (POST tylko dla ID, controller i do przez GET)
            echo "<form action='/praktyki24-25/public/index.php?controller=usermanagement&do=edit' method='POST'>";
            echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
            echo '<label for="name">Nazwa:</label>
            <input type="text" id="name" name="name" required value="' . htmlspecialchars($name) . '">
            <br><br>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required value="' . htmlspecialchars($email) . '">
            <br><br>
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" required value="' . htmlspecialchars($password) . '">
            <br><br>';
            echo "<input type='submit' value='Zatwierdź zmiany dla {$row['name']}'>";
            echo "</form>";
        }
    }



}