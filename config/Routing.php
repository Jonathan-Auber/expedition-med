<?php

namespace config;

use controllers\AdminController;

class Routing
{
    public function get()
    {

        if (isset($_GET["ctrl"])) {
            $url = htmlspecialchars($_GET["ctrl"]);

            $newUrl = explode("/", $url);
            $controllerName = "controllers\\" . ucfirst($newUrl[0]) . "Controller";
            if (isset($newUrl[1])) {
                $controller = new $controllerName();
                $methodName = strtolower($newUrl[1]);
                $controller->$methodName();
            } else {
                echo "erreur 404";
            }
        } else {

            $admin = new AdminController();
            $admin->index();
        }
    }
}
