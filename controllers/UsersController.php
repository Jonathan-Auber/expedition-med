<?php

namespace controllers;

use models\UsersRepository;

class UsersController
{
    private $user;

    public function __construct()
    {
        $this->user = new UsersRepository();
    }
    public function index()
    {
        $pageTitle = "Expedition Med";
        $page = "views/Index.phtml";
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
    public function sampling()
    {
        $pageTitle = "Sampling";
        $page = "views/AddSampling.phtml";
        require_once "views/Layout.phtml";
    }
}
