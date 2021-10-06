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

/** comment entity
 *   private $content;
 *   private $disabled; defaut
 *   private $id_article;
 *   private $id_user;
 */


        echo('| ControllerComment.php storeComment');

    //visiteur doit etre connecte
    if(isset($_SESSION['id_user'])){
        //Parie 1 - ok fonctionne
        $array = array('content'=> $_POST['content'],'id_article'=> $_SESSION['id_article'],'id_user'=>$_SESSION['id_user']);
        var_dump($array);

        $comment = new Comment($array);
        var_dump($comment);
        $commentManager = new CommentManager;
        $commentManager->addComment($comment);
        
        //Partie 2 - liste ok
        
        //Afficher les commentaires conserver la variable
        echo('| 2st partie storeComment - Affichage foreach ');
    
        //global $comments;
        $commentManager->getComments(); //$comments = var[]
        
    
        //Pb id article et id user non enregistre
        echo('OK -- voici le resultat de l insertion');
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