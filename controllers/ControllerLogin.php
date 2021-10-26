<?php
namespace Controllers;
session_start();

use View\View;
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
        elseif (isset($_GET['logout'])){
            $this->logout();       
        }        
        elseif (isset($_GET['status']) && isset($_GET['status']) =="login"){  
            if (isset($_POST['option']) && $_POST['option'] === 'on') {
                $checkbox = 'ADMIN';
            }else{
                $checkbox = 'MEMBRE';

            }
            $this->logon($checkbox);       
        }
    }

    private function formLogin(){
        $data ='';
        $this->_view = new View('Login', 'Login');
        $this->_view->displayForm('Login',$data);       
    }

    private function logon($usertype){
        if(($user=Security::login($usertype))!==null){
            header('Location: accueil&passe=valide');
        }
    else
        {
            header('Location: accueil&login=error');
        }
    }

    private function logout(){
        session_destroy();
        header('Location: accueil&session=terminated');
    } 
}