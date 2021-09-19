<?php
namespace Controllers;
use View\View;
use Manager\UserManager;

class ControllerContact
{
    public function __construct(){
        if(isset($url) && count($url) < 1){  
            throw new \Exception("Page introuvable", 1);
        }
        elseif (isset($_GET['create'])){
            $this->Message();        
            echo('controller option 1');
        }
        elseif (isset($_GET['status']) && isset($_GET['status']) =="send"){  
            $this->sendMessage();        
            echo('controller option 2');
        }
        else{
            echo('controller option 3');
        }
    }

    
    //Affichage
    private function Message(){ 
        $this->_view = new View('Contact', 'Contact'); 
        $this->_view->displayForm('Contact');       
    }

    //Traitement du formulaire. //
    // v
    private function sendMessage(){ 
        echo('finaliser function contact() UserManager.php');
        $this->_item = new UserManager;
        $this->_item->contact(); 
        
    }
}