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

    public function validationPrelevement($data)
    {
        $requiredFields = ['sample', 'sea', 'date', 'startTime', 'startLatitude', 'startLongitude'];

        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                echo "Champ '$field' manquant pour le prélèvement !";
                return false;
            }
        }

        return true;
    }

    public function formulairePrelevement()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;

            if ($this->validationPrelevement($data)) {
                // Les champs du formulaire sont valides, vous pouvez effectuer les actions nécessaires

                // Insérer les données dans la table "prelevements"
                $insert = $this->pdo->prepare("INSERT INTO prelevements (sample, sea, date, startTime, startLatitude, startLongitude, midLatitude, midLongitude, endLatitude, endLongitude, windForce, windSpeed, windDirection, seaState, waterTemperature, boatSpeed, startFlowmeter, endFlowmeter, filteredVolume, filteredDistance, filteredSurfaceKm, commentaires) VALUES (:sample, :sea, :date, :startTime, :startLatitude, :startLongitude, :midLatitude, :midLongitude, :endLatitude, :endLongitude, :windForce, :windSpeed, :windDirection, :seaState, :waterTemperature, :boatSpeed, :startFlowmeter, :endFlowmeter, :filteredVolume, :filteredDistance, :filteredSurfaceKm, :commentaires)");

                foreach ($data as $key => $value) {
                    $insert->bindParam(':' . $key, $data[$key]);
                }

                $insert->execute();

                // apres insertion ?

            }
        }
    }
    public function findAll()
    {
        $select = $this->pdo->prepare("SELECT * FROM prelevements");
        $select->execute();

        return $select->fetchAll();
    }
    public function findAllSample()
    {
        $select = $this->pdo->prepare("SELECT Sample FROM prelevements");
        $select->execute();

        return $select->fetchAll();
    }
    public function addTri($sample, $size, $type, $color, $number)
    {
        $add = $this->pdo->prepare("INSERT INTO tri (Sample, Size, Type, Color, Number) VALUES (?,?,?,?,?)");
        $add->execute(array($sample, $size, $type, $color, $number));
    }
    public function numberBySample()
    {
        $select = $this->pdo->prepare('select SUM(Number) as "total", Sample FROM tri GROUP BY Sample');
        $select->execute();

        return $select->fetchAll();
    }
}
