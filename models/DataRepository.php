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
                $insert = $this->pdo->prepare("INSERT INTO prelevements (Sample, Sea, Date, Start_Time, Start_Latitude, Start_Longitude, Mid_Latitude, Mid_Longitude, End_Latitude, End_Longitude, Wind_force, Wind_speed, Wind_direction, Sea_state, Water_temperature, Boat_speed, Start_flowmeter, End_flowmeter, Filtered_volume, Filtered_distance, Filtered_surface, Filtered_surface_km, Commentaires) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

                $insert->execute(array($data["sample"], $data["sea"], $data["date"], $data["startTime"], $data["startLatitude"], $data["startLongitude"], $data["midLatitude"], $data["midLongitude"], $data["endLatitude"], $data["endLongitude"], $data["windForce"], $data["windSpeed"], $data["windDirection"], $data["seaState"], $data["waterTemperature"], $data["boatSpeed"], $data["startFlowMeter"], $data["endFlowMeter"], $data["filteredVolume"], $data["filteredDistance"], $data["filteredSurface"], $data["filteredSurfaceKm"], $data["commentaires"]));

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
