<?php
namespace Controllers;
session_start();

use View\View;


 class ControllerProfile
 {

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