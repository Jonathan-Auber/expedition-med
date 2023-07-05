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
    $tableau = $this->data->tableTri($_POST);
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
  public function detailBySample($id)
  {
    $resultT = $this->data->findTypeBySample($id);
    $resultC = $this->data->findColorBySample($id);
    $resultS = $this->data->findSizeBySample($id);
    $details = $this->data->findDetailBySample($id);
    $pageTitle = "Expedition Med";
    $page = "views/DetailBySample.phtml";
    require_once "views/Layout.phtml";
  }
}
