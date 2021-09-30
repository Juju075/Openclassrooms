<?php
require 'vendor/autoload.php';
use Tools\Router;

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ .'/views');
$twig = new \Twig\Environment($loader, ['cache' => false, __DIR__ .'/tmp']);


/**
 * http://localhost/App_Blog_MVC/index.php?url=accueil
 * https://github.com/Juju075/Openclassrooms.git
 */

$router = new Router(); 
$router->routeReq();