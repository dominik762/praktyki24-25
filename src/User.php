<?php

namespace App;

use PDO;
use PDOException;
use App\Kernel;

class User {

    private static ?User $instance = null;
    private ?int $id = null;
    private ?string $name = null;
    private ?string $email = null;
    private ?string $password = null;
    private PDO $db;

    private function __construct()
    {
        $this->db = Kernel::getDatabase();
    }

    //gettery
    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getPassword() {
        return $this->password;
    }
    //settery
    public function setId($id) {
        $this->id = $id;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public static function getInstance(): User
    {
        if (self::$instance === null) {
            self::$instance = new User();
        }

        return self::$instance;
    }

    public function getUserId(int $id): ?self
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id,PDO::PARAM_INT);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        if($userData) {
            $this->id = $userData['id'];
            $this->name = $userData['name'];
            $this->email = $userData['email'];
            $this->password = $userData['password'];
            return $this;
        }
        return null;
    }
    public function  printUser():void
    {
        $user = $this->getUserId(1);
        if ($user) {
            echo "ID: " . $user->getId() . "<br>";
            echo "Imię: " . $user->getName() . "<br>";
            echo "Email: " . $user->getEmail();
        } else {
            echo "Użytkownik nie znaleziony";
        }
    }

}
