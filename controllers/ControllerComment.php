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
            $user=Security::retrieveUserObj($_SESSION['user']['usertype']);

            $array = array('content'=> $_POST['content'],'disabled'=> '0','id_article'=> $_SESSION['id_article'],'id_user'=>$_SESSION['id_user']);
            $comment = new Comment($array);  
            $this->commentManager = new CommentManager;
            $comment = $this->commentManager->addComment($comment);
            
            $this->commentManager->getComments();
            
            $id_comment = $this->commentManager->retriveIdComment($array['id_user'], $array['id_article'], $array['content']);
            var_dump($id_comment);
            //$this->sendMessage(); //admin&validation=comment&id=102&token=63aee5f60929e7e2aac8b25a3e826f0e   
            $_SESSION['routeNameForComment'] = 'post&comment=waiting';    
             header('Location: post&id_article='.$_SESSION['id_article']);
 
        }else{
            header('Location: accueil&comment=notconnected');
        }
    }


    private function updateOneComment($id_comment){
        echo('|ControllerComment. php updateOneComment');

        if(($user=Security::retrieveUserObj('MEMBRE'))!==null){ // Ok array pas obj       
            $this->commentManager = new CommentManager;
            $isAuthor = $this->commentManager->verifCommentAuthor($id_comment); //boll 

            if($isAuthor = true) {

                //afficher le form refresh page avec routename  'commentUpdateRequest'
                header('location: post&id_article='.$_SESSION['id_article']); //'commentUpdateRequest'
            }
            else{
                header('location: accueil');
                //Alert accueil
                //Alert vous n'etes pas l'auteur de ce commentaire!
            }
        } 
    }


    private function sendMessage(){
                /** SendEmail */

        $mail = new PHPMailer(true);

        try {
                //Server settings
                //SMTP::DEBUG_SERVER
                $mail->SMTPDebug = 0;                                          
                $mail->isSMTP();                                           
                $mail->Host       = 'smtp.gmail.com';                      
                $mail->SMTPAuth   = true;                                 
                $mail->Username   = 'transferts10plus@gmail.com';      
                $mail->Password   = 'b:6W[7Jx4';                            
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
                $mail->Port       = 465;                                    

                //Recipients (Admin).
                $mail->setFrom('user@blobMVC.com', 'Mailer');
                $mail->addAddress('checkout.enterprise@gmail.com', 'Administrateur joe');     

                //Content

                //generer le lien de validation
                $id_comment = null; //recuperer l'id fraichement creer
                $token =null;
                //admin&validation=comment&id=75&token=63aee5f60929e7e2aac8b25a3e826f0e
                $activationLink = 'dmin&validation=comment&id='.$id_comment.'&token='.$token;


                $mail->isHTML(true);                               
                $mail->Subject = 'Validez vous ce commentaire?';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();

                echo 'Message has been sent';
        }catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
