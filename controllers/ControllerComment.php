<?php
namespace controllers;
session_start();

use Entity\Comment;
use Manager\CommentManager;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ControllerComment
{
        public $commentManager;
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

    private function storeComment(){
            echo('| ControllerComment.php storeComment');

            var_dump($_SESSION['id_user']);

            if(isset($_SESSION['id_user'])){
                $array = array('content'=> $_POST['content'],'disabled'=> '0','id_article'=> $_SESSION['id_article'],'id_user'=>$_SESSION['id_user']);
                var_dump($array);
                
                $comment = new Comment($array);  
                echo('ici var dump comment');
                var_dump($comment);
                
                $this->commentManager = new CommentManager;
                $comment = $this->commentManager->addComment($comment); // null?



                //var_dump sur un get control de retour
                $result = $this->commentManager->getComments();
                var_dump($result);

                //envoie email admin pour validation.
                $admin = $this->sendMessage();
                    if ($admin === true) {
                        $this->commentManager->getComments(); 
                        header('location: post&id_article='.$_SESSION['id_article']);
                    }else{
                        header('location: accueil?login=connected');
                    }
                }
            else{
                header('Location: login&user' );
            }
    }

}