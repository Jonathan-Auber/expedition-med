<?php

namespace controllers;

use models\UsersRepository;

class DataController
{
    private $sample;
    private $sea;
    private $date;
    private $startTime;
    private $startLatitude;
    private $startLongitude;
    
    public function __construct($sample, $sea, $date, $startTime, $startLatitude, $startLongitude) {
       

       // Formulaire Prelevements
       $this->sample = $sample;
       $this->sea = $sea;
       $this->date = $date;
       $this->startTime = $startTime;
       $this->startLatitude = $startLatitude;
       $this->startLongitude = $startLongitude;

    }

    public function validationPrelevement() {
      // verif de champ de formulaire remplis
    if(empty($sample) || empty($sea) || empty($date) || empty($startTime) || empty($startLatitude) || empty($startLongitude))
    {
      echo "Champs manquants pour le prelevement !";
    }



    }

    public function formulairePrelevement() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
           
            $sample = $_POST['sample'] ?? '';
            $sea = $_POST['sea'] ?? '';
            $date = $_POST['date'] ?? '';
            $startTime = $_POST['start_time'] ?? '';
            $startLatitude = $_POST['start_latitude'] ?? '';
            $startLongitude = $_POST['start_longitude'] ?? '';

            $form = new DataController($sample, $sea, $date, $startTime, $startLatitude, $startLongitude);

            
            $form->validationPrelevement();


        }
        

    }
}