<?php
namespace controllers;


use Controllers\ControllerContact;
use controllers\ControllerPost;
use Entity\Comment;
use Manager\CommentManager;
use Manager\UserManager;

use Tools\Security;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ControllerComment extends ControllerContact
{
        public $commentManager;
        public $userManager;
        public $comments;
        public $comment;
        public $controller;


        public function __construct(){
            if(isset($url) && count($url) < 1){
                throw new \Exception("Page introuvable", 1);
                echo('ControllerComment.php construct |');
            }    
        elseif (isset($_GET['status']) && isset($_GET['status']) =="new"){       
            $this->storeComment($_GET['id_article']);
        }       
        //comment&id_article=96&update
        elseif (isset($_GET['id_comment'])){
            $this->updateOneComment($_GET['id_comment']); 
        }      

        }

    private function storeComment($id_article){ 
        if(isset($_SESSION['user'])){
            $this->commentManager = new CommentManager;

            if($this->commentManager->verifUserCommentArticle() === true){ 
                $user=Security::retrieveUserObj($_SESSION['user']['usertype']); //?
    
                $array = array('content'=> $_POST['content'],'disabled'=> '0','id_article'=> $_SESSION['id_article'],'id_user'=>$_SESSION['id_user']);
                $comment = new Comment($array);            

                $comment = $this->commentManager->addComment($comment);
                $this->commentManager->getComments(1);
                
                $id_comment = $this->commentManager->retriveIdComment(array($array['id_user'], $array['id_article'], $array['content']));     
                
                //token user ?
                $this->userManager = new UserManager;
                $userObj = $this->userManager->ProfilUser($array['id_user']);
                
                $token ='63aee5f60929e7e2aac8b25a3e826f0e';
                $url = 'admin&validation=comment&id='.$id_comment[0].'&token='.$token;
                


                //$this->commentManager->addCommentRequest($id_comment[0], $url); //erreur ici pb primary key



                $_SESSION['routeNameForComment'] = 'post&comment=waiting';   
                header('Location: post&id_article='.$_SESSION['id_article']);


            }else{ 
                $_SESSION['routeNameForComment'] = 'post&comment=already';
                header('Location: post&id_article='.$_SESSION['id_article']); 
            }
        }else{
            header('Location: accueil&comment=notconnected');
        }
    }


    private function updateOneComment($id_comment){
        echo('|ControllerComment. php updateOneComment');

        if(($user=Security::retrieveUserObj('MEMBRE'))!==null){   
            $this->commentManager = new CommentManager;
            $isAuthor = $this->commentManager->verifCommentAuthor($id_comment);

            if($isAuthor = true) {
                header('location: post&id_article='.$_SESSION['id_article']); //'commentUpdateRequest'
            }
            else{
                header('location: accueil');
                //Alert accueil
                //Alert vous n'etes pas l'auteur de ce commentaire!
            }
        } 
    }
}
