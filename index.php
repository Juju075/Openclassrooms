<?php
/**
 * http://localhost/App_Blog_MVC/index.php?url=accueil
 */
require_once('framework/Router.php');
$router = new Router(); 
$router->routeReq();