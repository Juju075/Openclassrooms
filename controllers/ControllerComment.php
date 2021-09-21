<?php
namespace controllers;

use View\View;
use Manager\CommentManager;

class ControllerComment
{

public function __construct(){
        if(isset($url) && count($url) < 1){
            throw new \Exception("Page introuvable", 1);
        }    
        elseif (isset($_GET['comment']) && isset($_GET['comment']) =="new"){ //Traitement
            $this->store();
        } 
}


//route comment new
//traitement function
//commentManager parametres
//Model 

//retour a la page de detail id
//rechargement des comments


}