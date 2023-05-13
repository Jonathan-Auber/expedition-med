<?php

namespace controllers;

use models\DataRepository;
use models\UsersRepository;

class UsersController
{
    private $user;
    private $data;

    public function __construct()
    {
        $this->user = new UsersRepository();
        $this->data = new DataRepository();
    }
    public function index()
    {
        $result = $this->data->findAll();
        $pageTitle = "Expedition Med";
        $page = "views/Index.phtml";
        require_once "views/Layout.phtml";
    }
    public function login()
    {
        $pageTitle = "Connexion";
        $page = "views/Login.phtml";
        require_once "views/Layout.phtml";
    }
    public function loginPost()
    {
        $result = $this->user->find($_POST["email"]);
        $message = $this->user->checkPassword($_POST["password"], $result);
        if ($message) {
            header("Location: /Hackaton/expedition-med/Users/sampling");
        } else {
            $erreur = "Mauvais mot de passe";
            $page = "views/Login.phtml";
            require_once "views/Layout.phtml";
        }
    }
    public function sampling()
    {
        $pageTitle = "Sampling";
        $page = "views/AddSampling.phtml";
        require_once "views/Layout.phtml";
    }
}
