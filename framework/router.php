<?php
namespace Tools;

//
require 'controllers/ControllerPost.php';

use Controllers\ControllerAccueil;
use View\View;


 class Router
 {
    private $ctrl; 
    private $view; 


    public function routeReq(){

    try {
        $class = 'Article'; 

        spl_autoload_register(
            function($class){ 
            echo('debugging ici $class');
            var_dump($class);

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
            var_dump($controllerFile);
            
            if (file_exists($controllerFile)){
                echo('le fichier existe');
                
                require_once('controllers/ControllerAccueil.php'); //en dur ca fonctionne
                //require_once($controllerFile); // ERREUR 2 ICI | import du fichier ici ok code passe

                echo('debugging $controllerClass');
                var_dump($controllerClass); //'ControllerAccueil'
                
                
                //Affectation de ctrl
                $this->ctrl = new $controllerClass($url);  // ERREUR 3 ICI |  
                echo('jusqu ici tout vas bien 1');

                //Cannot declare class controllers\ControllerPost, because the name is already in use

                echo('jusqu ici tout vas bien 2');
                
            }
            else{ 
                echo('le fichier n existe pas');

                throw new \Exception("Page introuvable", 1);
                }
            }
            else{  // Page par defaut si erreur | Marche
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