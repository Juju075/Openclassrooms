<?php
namespace controllers;
session_start();

use View\View;
use Manager\CommentManager;

class ControllerComment
{
    
        private $_commentManager;
        private $_view; 

        public function __construct(){
            if(isset($url) && count($url) < 1){
                throw new \Exception("Page introuvable", 1);
                echo('ControllerComment.php construct');
        }    
        elseif (isset($_GET['status']) && isset($_GET['status']) =="new"){ 
            $this->storeComment();
        }
        elseif (isset($_GET['status']) && isset($_GET['status']) =="update"){  
            $this->updateComment();
        }         

        elseif (isset($_GET['delete'])){
            $this->deleteOneComment(); 
        }

        else{
            //header('Location: ' );
        }        


}

    //Traitement add comment.
    private function storeComment(){
        echo('| ControllerComment.php storeComment');

        //Parie 1 - ok fonctionne
        $this->_commentManager = new CommentManager;
        $comment = $this->_commentManager->createComment($_POST['comment']);
//
        
        //Afficher les commentaire
        echo('Maintenant affichage aditionnel des comments foreach');
        $comments = $this->_commentManager->getComments(); //
        
        // $this->_view = new View('Post','Comment');
        // $this->_view->generatePost(array('comments' =>$comments));
    }
    



    private function updateComment(){
        echo('| ControllerComment.php function updateComment');
        
    }
    


    private function deleteOneComment(){
        echo('| ControllerComment.php function deleteComment');

    }


}