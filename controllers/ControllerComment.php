<?php
namespace controllers;
session_start();
echo('ControllerComment.php user session | ');
var_dump($_SESSION['id_user']);

use Manager\CommentManager;

class ControllerComment
{
    
        private $_commentManager;
        public $comments;

        public function __construct(){
            if(isset($url) && count($url) < 1){
                throw new \Exception("Page introuvable", 1);
                echo('ControllerComment.php construct |');
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

    //visiteur doit etre connecte
    if(isset($_SESSION['id_user'])){

        //Parie 1 - ok fonctionne
        $this->_commentManager = new CommentManager;
        $comment = $this->_commentManager->createComment($_POST['comment']);
        
        //Partie 2 - liste ok
        
        //Afficher les commentaires conserver la variable
        echo('| 2st partie storeComment - Affichage foreach ');
    
        //global $comments;
        $this->_commentManager = new CommentManager;
        $comments = $this->_commentManager->getComments(); //$comments = var[]
        
    
        //Pb id article et id user non enregistre
        echo('OK -- voici le resultat de l insertion');
        var_dump($comments); //recuperation des datas de comment table.
    }else{
         header('location: accueil?login=connected');
    }



    }


    private function updateComment(){
        echo('| ControllerComment.php function updateComment');
        
    }
    

    private function deleteOneComment(){
        echo('| ControllerComment.php function deleteComment');

    }


}