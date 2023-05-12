<?php

namespace models;

use PDO;

class UsersRepository
{

    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = \config\Database::getpdo();
    }
    public function findAll()
    {
        $select = $this->pdo->prepare("SELECT * FROM user");
        $select->execute();

        return $select->fetchAll();
    }
}
