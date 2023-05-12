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
}
