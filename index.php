<?php
require 'vendor/autoload.php';
use Tools\Router;
/**
 * http://localhost/App_Blog_MVC/index.php?url=accueil
 * https://github.com/Juju075/Openclassrooms.git
 */
$router = new Router(); 
$router->routeReq();
