<?php
namespace Controllers;
use View\View;

/**
* require_once('models/Manager/ArticleManager.php'); 
 */

 class ControllerIntro
 {
    private $_articleManager;
    private $_view; 

     public function __construct(){
         if(isset($url) && count($url) > 1){ 
            throw new \Exception("Page introuvable", 1);
        } 
        else{
            $this->presentation();  
        }       
     }

     //Affiche un contenu simple pas de repository
     private function presentation(){

        $this->_view = new View('intro', 'Intro');

        $this->_view->displayForm('Intro'); 
     }

}