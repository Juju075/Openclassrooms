<?php
namespace Tools;

//
require 'controllers/ControllerPost.php';

use Controllers\ControllerAccueil;
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
            var_dump($controllerFile);
            
            if (file_exists($controllerFile)){
                echo('le fichier existe');
                
                //require_once($controllerFile); // ERREUR ICI | import du fichier ici ok code passe
                require_once('controllers/ControllerAccueil.php'); //en dur ca fonctionne
                
                var_dump($controllerClass);
                
                
                //Affectation de ctrl
                $this->ctrl = new $controllerClass($url);  // ERREUR ICI | 
                echo('jusqu ici tout vas bien 1');
                echo($ctrl); //ok
                //Cannot declare class controllers\ControllerPost, because the name is already in use

                echo('jusqu ici tout vas bien 2');
                
            }
            else{ 
                echo('le fichier n existe pas');

                throw new \Exception("Page introuvable", 1);
                }
            }
            else{  // Page par defaut si erreur | Marche
                //require_once('controllers/ControllerAccueil.php'); fonctionne sans ok
                $this->ctrl = new ControllerAccueil($url);
                echo($ctrl);
            }

        } catch(\Exception $e){ 
            $errorMsg = $e->getMessage();

            $this->_view = new View('Error','Post'); 
            $this->_view->generate(array('errosMsg'=>$errorMsg));
            require_once('views/viewError.php'); 
        }
    }
}