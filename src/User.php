<?php

namespace App;

use App\Kernel;
use PDO;
use PDOException;

class User {

    private ?int $id = null;
    private ?string $name = null;
    private ?string $email = null;
    private ?string $password = null;
//    private PDO $db;

    public function __construct()
    {
//        $this->db = Kernel::getInstance()->getDatabase();
    }

    //gettery
    public function getId():?int {
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
    //settery
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
        $db = Kernel::getInstance()->getDatabase();
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id,PDO::PARAM_INT);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_OBJ);
        if($userData) {
            $user = new self($db);
            $user->setId($userData->id);
            $user->setName($userData->name);
            $user->setEmail($userData->email);
            $user->setPassword($userData->password);

            return $user;
        }
        return null;
    }

}
