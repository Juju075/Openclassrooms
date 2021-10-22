<?php
namespace Controllers;
session_start();

use Manager\UserManager;
use View\View;


 class ControllerProfile
 {
    private $userManager;
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
      if(isset($_SESSION['id_user'])){
      }else{
          header('Location: accueil&comment=notconnected' );
      }

      //get User connected ok
      $this->usermanager = new UserManager;
      $data = $this->usermanager->ProfilUser();

      //View
        $this->_view = new View('Profile', 'Profile');
        $this->_view->displayForm('Profile',$data); 
     }
}