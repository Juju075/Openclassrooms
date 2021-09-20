<?php
namespace Tools;

use Controllers\ControllerAccueil;
use View\View;


 class Router
 {
    private $_ctrl; 
    private $_view; 


    public function routeReq(){

    try {
        $class = 'Article'; //corrige mettre duynamique
        spl_autoload_register(
            function($class){ 
            require_once('models/Entity/Article.php');
            //require_once('models/Entity/'.$class.'.php'); //Bizzare  // ERREUR 1 ICI | Entite pas controlleur
            }
        );
        $url = '';

        if (isset($_GET['url'])){
            $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
            $controller = ucfirst(strtolower($url[0])); 
            $controllerClass = "Controller".$controller;  
            $controllerFile = "controllers/".$controllerClass.".php";
            
            if (file_exists($controllerFile)){
                require_once($controllerFile); 
                $controllerClass="\\Controllers\\".$controllerClass;

                //Affectation de ctrl
                $this->ctrl = new $controllerClass($url);   
            }
            else{ 
                throw new \Exception("Page introuvable", 1);
                }
            }
            else{  
                $this->_ctrl = new ControllerAccueil($url);
            }

        } catch(\Exception $e){ 
            $errorMsg = $e->getMessage();

            $this->_view = new View('Error','Post'); 
            $this->_view->generate(array('errosMsg'=>$errorMsg));
            require_once('views/viewError.php'); 
        }
    }
}