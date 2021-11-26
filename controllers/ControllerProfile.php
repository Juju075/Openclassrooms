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

    private function myProfile(){
        if(($user=Security::retrieveUserObj('MEMBRE'))!==null){
            $this->userManager = new UserManager;
            $userObj = $this->userManager->ProfilUser($_SESSION['id_user']);
        
            $this->_view = new View('Profile', 'Profile');
            $this->_view->displayForm('Profile', $userObj); 
        }else{
             header('Location: listing&comment=notconnected' );
            }    
    }
}
