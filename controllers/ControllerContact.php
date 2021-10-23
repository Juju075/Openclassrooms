<?php
namespace Controllers;
session_start();

use Manager\UserManager;
use View\View;
use Entity\User;
use Manager\ContactManager;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ControllerContact
{

    private $contactManager;
    private $user;


    public function __construct(){
        if(isset($url) && count($url) < 1){  
            throw new \Exception("Page introuvable", 1);
        }
        elseif (isset($_GET['create'])){
            $this->Message();        
        }
        elseif (isset($_GET['status']) && isset($_GET['status']) =="send"){  
            $this->sendMessage();        
        }
        else{
        }
    }

    
    private function Message(){ 
        echo('controllerContact function Message');

        if(isset($_GET['create'])){
            //View
            $this->_view = new View('Contact', 'Contact'); 
            $this->_view->displayForm('Contact');       
        }
    }

    private function sendMessage(){ 
        //Create an instance; passing `true` enables exceptions
        echo('controllerContact sendMessage');

        
        //recuperer data user
        $this->contactManager = new ContactManager;
        $user[] = $this->contactManager->getUser($_SESSION['id_user']);
        var_dump($user);
        var_dump($user[0]);

        //ajout POST 
        $_POST['prenom']= 'ajoute cidi';
        $_POST['nom']= $user[0]['nom'];
        $_POST['email']= $user[0]['email'];

        var_dump($_POST);
        exit;



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
            $mail->setFrom('user@blobMVC.com', 'Mailer');
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






            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = $_POST['message'];
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
            header('location: accueil?message=send');


            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            
    }

}