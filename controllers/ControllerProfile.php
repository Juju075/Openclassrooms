<?php
namespace Controllers;
session_start();

use Manager\UserManager;
use View\View;
use Tools\Security;
use Entity\User;


 class ControllerProfile
 {
    private $usermanager;
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
        //usertype connecte
        if(($user=Security::retrieveUserObj($_SESSION['user']['usertype']))!==null){

            $this->userManager = new UserManager;
            $userObj = $this->userManager->ProfilUser($_SESSION['id_user']); //Objet
            var_dump($userObj);
            //prenom
            $this->variable = new User($userObj);
            $prenom = $this->variable->getPrenom();

            var_dump($prenom);
            //nom
            //sentence

            $this->_view = new View('Profile', 'Profile');
            $this->_view->displayForm('Profile', $userObj); 
        }else{
             header('Location: accueil&comment=notconnected' );
            }    
    }
}
