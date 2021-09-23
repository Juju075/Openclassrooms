<?php
namespace Controllers;
use View\View;
use Entity\Article;


 class ControllerProfile
 {
    private $_articleManager;
    private $_view; 

     public function __construct(){
        
         if(isset($url) && count($url) > 1){ 
            throw new \Exception("Page introuvable", 1);
        } 
        else{
            $this->myProfile();  
        }       
     }

     //Affiche un contenu simple pas de repository
     private function myProfile(){
      echo('ControllerProfile.php myProfile');
        $this->_view = new View('Profile', 'Profile');

        $this->_view->displayForm('Profile'); 
     }

}