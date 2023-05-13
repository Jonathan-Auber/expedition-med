<?php

namespace controllers;

use models\DataRepository;
use models\UsersRepository;

class DataController
{
  private $data;
  private $user;

  public function __construct()
  {
    $this->data = new DataRepository();
    $this->user = new UsersRepository();
  }
  public function tri()
  {
    $this->user->checkConnexion($_SESSION["id"]);
    $pageTitle = "Expedition Med";
    $page = "views/AddTri.phtml";
    require_once "views/Layout.phtml";
  }
  public function select()
  {
    $this->user->checkConnexion($_SESSION["id"]);
    $result = $this->data->findAllSample();
    echo json_encode($result);
  }
  public function triPost()
  {
    $this->user->checkConnexion($_SESSION["id"]);
    for ($i = 1; $i <= count($_POST) / 5; $i++) {
      $sous_tableau = array(
        "sample" => $_POST["sample_" . $i],
        "size" => $_POST["size_" . $i],
        "type" => $_POST["type_" . $i],
        "color" => $_POST["color_" . $i],
        "number" => $_POST["number_" . $i]
      );
      $tableau[] = $sous_tableau;
    }
    foreach ($tableau as $tableau2) {
      $this->data->addTri($tableau2["sample"], $tableau2["size"], $tableau2["type"], $tableau2["color"], $tableau2["number"]);
    }
    return header('Location: /Hackaton/expedition-med/index');
  }
  public function plastiqueSum()
  {
    $result = $this->data->numberBySample();
    echo json_encode($result);
  }
  public function PushPrelevement()
  {
    $this->data->formulairePrelevement();
    return header('Location: /Hackaton/expedition-med/Data/tri');
  }
  public function detailPrelevement()
  {
  }
}
