<?php
namespace controllers;

use View\View;
use Manager\CommentManager;

class ControllerComment
{

public function __construct(){
    echo('controllerComment.php');
        if(isset($url) && count($url) < 1){
            throw new \Exception("Page introuvable", 1);
        }    
        elseif (isset($_GET['status']) && isset($_GET['status']) =="new"){ 
            $this->storeComment();
        }
        elseif (isset($_GET['status']) && isset($_GET['status']) =="update"){  
            $this->updateComment();
        }         
         elseif (isset($_GET['status']) && isset($_GET['status']) =="delete"){  
            $this->deleteComment();
        }        


}


//route comment new
//traitement function
//commentManager parametres
//Model 

//retour a la page de detail id
//rechargement des comments

    //Traitement add comment.
    private function storeComment(){
        echo('controllerComment.php function storeComment');
        
        $this->_articleManager = new CommentManager;
        $comment = $this->_articleManager->createComment();
        //$comments = $this->_articleManager->getComments();
        
        $this->_view = new View('Post','Comment');
        //$this->_view->generate(array('comment' =>$comments));
    }
    
    private function updateComment(){
        echo('controllerComment.php function updateComment');
        
    }
    
    private function deleteComment(){
        echo('controllerComment.php function deleteComment');

    }


}