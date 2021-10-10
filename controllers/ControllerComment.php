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
                $admin = $this->sendCommentRequest();
                    if ($admin === true) {
                        $this->commentManager->getComments(); 
                        header('location: post&id_article='.$_SESSION['id_article']);
                    }else{
                        header('location: accueil?login=connected');
                    }
                }
            else{}
    }

    private function sendCommentRequest()
    {
         
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            //SMTP::DEBUG_SERVER
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'transferts10plus@gmail.com';            //SMTP username
            $mail->Password   = 'b:6W[7Jx4';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            //mettre email expedi
            $mail->setFrom($_SESSION['email'], 'Mailer');
            $mail->addAddress('checkout.enterprise@gmail.com', 'Administrateur joe');     //Add a recipient
           

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            //ajouter automatiquement des information a message


            /** INSERTION DANS POST     
             * getFullname
             * getEmail
             * genere lien d'activation
             */


             //


            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Demande de validation de commentaire';
            $lienValidation ='admin?commentvalidation=id_comment&validation_key=7d7d0084752f82f54a40eadc40741e08'; 
            $mail->Body    = 'Bonjour Mr l\'administrateur voici mon commentaire concernant l\'article '. "". $_SESSION['id_article'] ."".$_POST['content'].
            'voici le lien pour le valider'."    ".$lienValidation;


            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
            header('location: accueil?message=send');


            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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