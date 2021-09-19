<?php
namespace Controllers;
use View\View;
use Manager\UserManager;

class ControllerLogin
{
    public function __construct(){
        if(isset($url) && count($url) < 1){ 
            throw new \Exception("Page introuvable", 1);
        }
        elseif (isset($_GET['user'])){
            $this->login();        
            echo('controller option 1-a');
        }
        elseif (isset($_GET['forgot'])){
            $this->forgot();       
            echo('controller option 1-b');
        }        
        elseif (isset($_GET['status']) && isset($_GET['status']) =="login"){  
            $this->logon();       
            echo('controller option 2');
        }
        else{
            echo('controller option 3');
        }
    }

    private function login(){
        $this->_view = new View('Login', 'Login');
        $this->_view->displayForm('Login');       
    }


    private function logon(){
    echo('function longon applique');
    $credentials = array('username'=> $_POST['username'],'password'=> $_POST['password']);
    $this->_item = new UserManager;
    $this->_item->login($credentials);
 
    }
    private function forgot(){  
        
    }
    
}