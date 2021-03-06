<?php
namespace controllers;

use Controllers\ControllerContact;
use controllers\ControllerPost;
use Entity\Comment;
use Manager\CommentManager;
use Manager\UserManager;
use Entity\Moderator;

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
        public $moderator;


        public function __construct(){
            if(isset($url) && count($url) < 1){
                throw new \Exception("Page introuvable", 1);
                echo('ControllerComment.php construct |');
            }    
        elseif (isset($_GET['status']) && isset($_GET['status']) =="new"){       
            $this->storeComment($_GET['id_article']);
        }       
        elseif (isset($_GET['id_comment'])){
            $this->updateOneComment($_GET['id_comment']); 
        }     

        }

    private function storeComment($id_article){ 
        if(isset($_SESSION['user'])){
            $this->commentManager = new CommentManager;
            if($this->commentManager->verifUserCommentArticle() === TRUE){ 
                $securedPost = array_map( 'htmlspecialchars' , $_POST );
                $array = array('content'=> $securedPost['content'],'disabled'=> '0','id_article'=> $_SESSION['id_article'],'id_user'=>$_SESSION['id_user']);
                $comment = new Comment($array);            
                $comment = $this->commentManager->addComment($comment);

                $this->commentManager->getComments(1);
                
                $id_comment = $this->commentManager->retriveIdComment(array($array['id_user'], $array['id_article'], $array['content']));  

                $this->userManager = new UserManager;
                $this->userManager->ProfilUser($array['id_user']);

                $token = $this->commentManager->retrieveToken();

                $url = 'admin&validation=comment&id='.$id_comment['id_comment'].'&token='.$token;  
                $erase = 'admin&comment=delete&id='.$id_comment['id_comment'];

                
                $stagedComment = array('id_comment'=>$id_comment['id_comment'],'link'=>$url, 'erase'=>$erase);
                
                $moderator = new Moderator($stagedComment);
                $this->commentManager->addCommentRequest($moderator);
                $this->commentManager->addCommentRequestSkipGetOne($stagedComment);

                $_SESSION['routeNameForComment'] = 'post&comment=waiting';   
                header('Location: post&id_article='.$_SESSION['id_article']);
            }else{ 
                $_SESSION['routeNameForComment'] = 'post&comment=already';
                header('Location: post&id_article='.$_SESSION['id_article']); 
            }
        }else{
            header('Location: listing&comment=notconnected');
        }
    }

    private function updateOneComment($id_comment){
        if(($user=Security::retrieveUserObj('MEMBRE'))!==null){   
            $this->commentManager = new CommentManager;
            $isAuthor = $this->commentManager->verifCommentAuthor($id_comment);

            if($isAuthor = true) {
                header('location: post&id_article='.$_SESSION['id_article']); 
            }
            else{
                header('location: listing');
            }
        } 
    }

    private function deleteOneComment(){
        $this->commentManager = new CommentManager;
        $$this->commentManager->deleteOneComment();
    }
}
