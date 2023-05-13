<?php

namespace models;

use PDO;

class DataRepository
{

    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = \config\Database::getpdo();
    }
    public function findAll()
    {
        $select = $this->pdo->prepare("SELECT * FROM prelevements");
        $select->execute();

        return $select->fetchAll();
    }
}
