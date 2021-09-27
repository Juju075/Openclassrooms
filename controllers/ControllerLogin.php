<?php
namespace Controllers;
session_start();

use user;
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
            $this->login();        
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

    private function login(){
        echo('ControllerLoging.php login');

        $this->_view = new View('Login', 'Login');
        $this->_view->displayForm('Login');       
    }


    private function logon(){
    echo('ControllerLogin.php logon');
    $credentials = array('username'=> $_POST['username'],'password'=> $_POST['password']);
    $this->_item = new UserManager;
    $this->_item->login($credentials);
    

    //creer la session user
    //rech ds bdd
    
    $_SESSION['id_user'] = 14;
    //$_SESSION['id_user'] = $this->_item->getId_user();
 

    
    }

    private function logout(){
        session_destroy();
        header('Location: /accueil');
    }

    
}