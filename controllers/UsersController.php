<?php

namespace controllers;

use models\UsersRepository;

class UsersController
{
    public function index()
    {
        $pageTitle = "Expedition Med";
        $page = "views/UsersAccueil.phtml";
        require_once "views/Layout.phtml";
    }
    public function users()
    {
        $data = new UsersRepository();
        $result = $data->findAll();
        $page = "views/AdminUsers.phtml";
        require_once "views/Layout.phtml";
    }
    public function login()
    {
        $pageTitle = "Connexion";
        $page = "views/Login.phtml";
        require_once "views/Layout.phtml";
    }
}
