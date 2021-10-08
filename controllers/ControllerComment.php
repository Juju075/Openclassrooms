<?php
namespace controllers;
session_start();

use Entity\Comment;
use Manager\CommentManager;

class ControllerComment
{
    
        private $commentManager;
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
                $array = array('content'=> $_POST['content'],'disabled'=> '1','id_article'=> $_SESSION['id_article'],'id_user'=>$_SESSION['id_user']);

                $comment = new Comment($array);
                $commentManager = new CommentManager;
                $commentManager->addComment($comment);
                $commentManager->getComments(); 
                header('location: post&id_article='.$_SESSION['id_article']);
            }else{
                header('location: accueil?login=connected');
            }
    }

    private function updateComment(){
        echo('| ControllerComment.php function updateComment');
        
    }
    
    private function deleteOneComment($id){
        echo('| ControllerComment.php function deleteComment');

        // lien bouton commentaire X supprimer html a l'affichage
        //
        $this->CommentManager = new CommentManager;
        $this->CommentManager->deleteThisComment();
        header('Location: post&id_article='.$_SESSION['id_article']);       
    }





}