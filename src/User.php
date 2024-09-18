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

        $stmt->setFetchMode(PDO::FETCH_CLASS,static::class);
        $user = $stmt->fetch();
        if($user) {
            return $user;
        }
        return null;
    }
    public static function findByEmail(string $email):?self
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email,PDO::PARAM_STR);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS,static::class);
        $user = $stmt->fetch();
        if($user) {
            return $user;
        }
        return null;
    }

}
