<?php

namespace App;

use App\Kernel;
use PDO;
use PDOException;

class User
{

    private ?int $id = null;
    private ?string $name = null;
    private ?string $email = null;
    private ?string $password = null;

    public function __construct()
    {
    }

    public function getId():?int
    {
        return $this->id;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function getPassword(): ?string
    {
        return $this->password;
    }


    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public static function find(int $id): ?self
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id,PDO::PARAM_INT);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS,self::class);
        $user = $stmt->fetch();
        if($user) {
            return $user;
        }
        return null;
    }
    public static function addUser(): void
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
