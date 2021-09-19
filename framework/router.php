<?php
namespace Tools;

use controllers\ControllerAccueil;
use View;

 class Router
 {
    private $ctrl; 
    private $view; 


    public function routeReq(){

    try {
        $class = 'Article'; 

        spl_autoload_register(function($class){ 
        require_once('models/Entity/Article.php');
        //require_once('models/'.$class.'.php'); //Bizzare
        });


        $url = '';

        if (isset($_GET['url'])){

            $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

            $controller = ucfirst(strtolower($url[0])); 
            $controllerClass = "Controller".$controller;  
         

            $controllerFile = "controllers/".$controllerClass.".php";
            
            if (file_exists($controllerFile)){

                require_once($controllerFile);
                $this->ctrl = new $controllerClass($url); 
            }
            else{ 

                throw new \Exception("Page introuvable", 1);
                }
            }
            else{  // Page par defaut si erreur
                require_once('controllers/ControllerAccueil.php');
                $this->ctrl = new ControllerAccueil($url);
            }

        } catch(\Exception $e){ 
            $errorMsg = $e->getMessage();

            $this->_view = new View('Error','Post'); 
            $this->_view->generate(array('errosMsg'=>$errorMsg));
            require_once('views/viewError.php'); 
        }
    }
}