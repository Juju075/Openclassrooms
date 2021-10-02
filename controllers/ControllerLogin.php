<?php
namespace Controllers;
session_start();

use Entity\User;
use View\View;
use Manager\UserManager;
use Tools\security;

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


    // we can verify session using login methode and we can make decision according to returned response for
    private function logon(){
    if(($user=Security::login(1))!=null){
        echo('| ControllerLoging.php logon true');
        //access granted make some business logic here 
        var_dump($user);
        header('Location: accueil?passe=valide');
    }
    else
    {
        echo('| ControllerLoging.php logon else ');
        //redirection or error message
        var_dump($user);
        header('Location: accueil?login=error');
    }
    }


    private function logout(){
        session_destroy();
        header('Location: accueil?session=terminated');
    }
    private function alert(){
        
    }

    
}