<?php
require dirname(__DIR__).'/vendor/autoload.php';
use Tools\Router;

require_once('framework/Router.php');

/**
 * http://localhost/App_Blog_MVC/index.php?url=accueil
 * https://github.com/Juju075/Openclassrooms.git
 */

$router = new Router(); 
$router->routeReq();