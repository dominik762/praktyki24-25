<?php

namespace App\Controllers;

use App\Database;
use App\Exceptions\UndefinedRouteException;
use App\Exceptions\ValidationException;
use App\Redirect;
use App\User;
use App\View;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use PDO;

/**
 * @throws ValidationException
 */
class AuthUserController
{
    private static function validatePassword(string $password, string $passwordConfirmation): void
    {
        if (!isset($password) || !isset($passwordConfirmation)) {
            throw new ValidationException("Trzeba podać hasło!");
        }
        if ($password == $passwordConfirmation) {
            if (strlen($password) < 6) {
                throw new ValidationException("W haśle trzeba zawrzeć minimum 6 znaków!");
            }
        } else {
            throw new ValidationException("Hasła nie są takie same!");
        }
    }

    private static function validateEmail(string $email): void
    {
        if (!isset($email)) {
            throw new ValidationException("Trzeba podać email!");
        }
        $db = Database::getInstance();
        $sql = "SELECT email FROM users";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $emails = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($emails as $em) {
            if ($email == $em->email) {
                throw new ValidationException("Taki email już istnieje");
            }
        }
    }

    private static function validateName(string $name): void
    {
        if (!isset($name)) {
            throw new ValidationException("Trzeba podać imię!");
        }
    }

    private static function validateRequestData(array $data): void
    {
        self::validateName($data['name']);
        self::validateEmail($data['name']);
        self::validatePassword($data['password'], $data['password_confirmation']);
    }


    public function signIn(): void
    {
        if (empty($_SESSION['userId'])) {
            View::render('UserManagement.AuthUser.signIn',[
                'absolute_url'=>$_ENV['APP_ABSOLUTE_URL'],
            ]);
        } else {
            Redirect::to('dashboard.show');
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
        Redirect::to('usermanagement.showAll');
    }

    /**
     * @throws FileNotFoundException
     * @throws UndefinedRouteException
     */
    public function login(): void
    {
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {

            $email = $_POST['email'];
            $providedPassword = $_POST['password'];
            $user = User::findByEmail($email);
            $isPasswordValid = password_verify($providedPassword, $user->getPassword());
            if ($isPasswordValid) {
                $userId = $user->getId();
                $_SESSION['userId'] = $userId;
                Redirect::to('dashboard.show');
            }
        }
    }

    /**
     * @throws FileNotFoundException
     * @throws UndefinedRouteException
     */
    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        Redirect::to('authuser.signIn');
    }

    public function signOut(): void
    {
        if (isset($_SESSION['userId'])) {
            $userId = $_SESSION['userId'];
            $user = User::find($userId);
            View::render(
                'UserManagement.AuthUser.signOut',
                [
                    'name' => $user->getName(),
                    'absolute_url'=>$_ENV['APP_ABSOLUTE_URL'],
                ]
            );
        }
        else{
            throw new \Exception("Brak userId");
        }
    }
}
