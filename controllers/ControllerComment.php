<?php
namespace controllers;

use View\View;
use Manager\CommentManager;

class ControllerComment
{
        private $_commentManager;
        private $_view; 

        public function __construct(){
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
        echo('| ControllerComment.php function storeComment');
        
        $this->_commentManager = new CommentManager;
        $comment = $this->_commentManager->createComment(); //ok insert bdd
        $comments = $this->_commentManager->getComments();
        
        $this->_view = new View('Post','Comment');
        $this->_view->generate(array('comments' =>$comments));
    }
    
    private function updateComment(){
        echo('| ControllerComment.php function updateComment');
        
    }
    
    private function deleteComment(){
        echo('| ControllerComment.php function deleteComment');

    }


}