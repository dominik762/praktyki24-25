<?php

namespace App\Controllers;

use App\Database;
use App\Exceptions\UndefinedControllerException;
use App\User;
use App\View;
use PDO;

class AuthUser
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private static function validatePassword(mixed $password, mixed $passwordConfirmation):void
    {
        if(!isset($_POST['password']) && !isset($_POST['password_confirmation'])) {
            throw new UndefinedControllerException("Trzeba podac haslo!");
        }
        if ($password==$passwordConfirmation)
        {
            $ilosc_znakow = strlen($password);
            if ($ilosc_znakow < 6){
                throw new UndefinedControllerException("W hasle trzeba zawrzec minimum 6 znaków!");
            }
        }
        else{
            throw new UndefinedControllerException("Hasła nie są takie same!");
        }
    }

    private static function validateEmail(mixed $name)
    {
        if(!isset($_POST['email'])) {
            throw new UndefinedControllerException("Trzeba podac email!");
        }
        $db = Database::getInstance();
        $sql = "SELECT email FROM users";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $emails = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($emails as $em) {
            if ($_POST['email'] == $em->email) {
                throw new UndefinedControllerException("Taki email już istnieje");
            }
        }
    }

    private static function validateName(mixed $name)
    {
        if(!isset($_POST['name'])) {
            throw new UndefinedControllerException("Trzeba podac imie!");
        }
    }

    private static function validateRequestData()
    {
        self::validateName($_POST['name']);
        self::validateEmail($_POST['name']);
        self::validatePassword($_POST['password'], $_POST['password_confirmation']);
    }

    /**
     * @throws UndefinedControllerException
     */
    public function signIn(): void
    {
        if(empty($_SESSION['userId'])) {
            View::render('UserManagement.AuthUser.signIn');
        } else {
            header('Location: /praktyki24-25/public/index.php?controller=dashboard&do=show');
            exit();
        }
    }

    public function register(): void
    {
        self::validateRequestData($_POST);
        $db = Database::getInstance();
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO users (id, name, email, password) VALUES (null, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                $name,
                $email,
                $password
            ]);
//        }
    }



    public function login(): void
    {
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {

            $email = $_POST['email'];
            $password = $_POST['password'];

            if (true === self::verifyPassword($password, $email)) {
                $user = User::findByEmail($email);
                if (isset($user)) {
                    $userId = $user->getId();

                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['userId'] = $userId;
                    var_dump($_SESSION);

                    header('Location: /praktyki24-25/public/index.php?controller=dashboard&do=show');
                    exit();
                }
            }
        }
    }


    private static function verifyPassword(mixed $password,mixed $email):bool
    {
        $user = User::findByEmail($email);
        if(isset($user)) {
            $hash = $user->getPassword();
        }
        return password_verify($password, $hash);
    }

    public function logout(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = [];
            session_destroy();



            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
        }
        var_dump($_SESSION);

        header('Location: /praktyki24-25/public/index.php?controller=dashboard&do=show');
        exit();
    }
    public function signOut(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['userId'])) {
            $userId = $_SESSION['userId'];
            $user = User::find($userId);
            View::render(
                'UserManagement.AuthUser.signOut',
                [
                    'name' => $user->getName(),
                ]
            );
        }
    }


}