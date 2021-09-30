<?php
namespace Controllers;
session_start();

use Entity\User;
use View\View;
use Manager\UserManager;

class ControllerLogin
{

    private $id_user;

    public function __construct(){


         

        if(isset($url) && count($url) < 1){ 
            throw new \Exception("Page introuvable", 1);
        }
        elseif (isset($_GET['user'])){
            $this->formLogin();        
        }
        elseif (isset($_GET['login']) && isset($_GET['login']) =="notconnected"){  
            $this->alert();       
        }         
        elseif (isset($_GET['logout'])){
            $this->logout();       
        }        
        elseif (isset($_GET['status']) && isset($_GET['status']) =="login"){  
            $this->logon();       
        }
        else{
        }
    }

    private function formLogin(){
        echo('ControllerLoging.php formLogin');
        $this->_view = new View('Login', 'Login');
        $this->_view->displayForm('Login');       
    }


    private function logon(){ //Traite le form de login.
    echo('ControllerLogin.php logon');
    $credentials = array('username'=> $_POST['username'],'password'=> $_POST['password']);
    $this->_item = new UserManager;
    $this->_item->login($credentials);

    //Hack utiliser username et pass pour id user

    
    //Recuperer et affecter  lid user
    $_SESSION['id_user'] = 14;
    }

    private function logout(){
        session_destroy();
        header('Location: http://localhost/App_Blog_MVC/accueil');
    }
    private function alert(){
        
    }

    
}