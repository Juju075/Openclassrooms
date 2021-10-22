<?php
namespace controllers;


use Controllers\ControllerContact;
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

        public function __construct(){
            if(isset($url) && count($url) < 1){
                throw new \Exception("Page introuvable", 1);
                echo('ControllerComment.php construct |');
        }    
        elseif (isset($_GET['status']) && isset($_GET['status']) =="new"){ 
            $this->storeComment();
        }       

        //comment&id_article=96&update
        elseif (isset($_GET['id_comment'])){
            $this->updateOneComment($_GET['id_comment']); 
        }        
        


        elseif (isset($_GET['delete'])){
            $this->deleteOneComment($_SESSION['id_article']); 
        }
        else{
            header('Location: ' );
        }        
}

    private function storeComment(){
echo('ControllerComment storeComment');

                if(($user=Security::retrieveUserObj('MEMBER'))!=null){ //   
                $array = array('content'=> $_POST['content'],'disabled'=> '0','id_article'=> $_SESSION['id_article'],'id_user'=>$_SESSION['id_user']);
                $comment = new Comment($array);  
                $this->commentManager = new CommentManager;
                $comment = $this->commentManager->addComment($comment);
                
                $this->commentManager->getComments();

                //Validation du commentaire dans la bdd.

                //envoie email admin pour validation.  ControllerContact sendMessage
                //$requestAdmin = $this->sendMessage(); //admin&validation=comment&id=75&token=63aee5f60929e7e2aac8b25a3e826f0e
                var_dump($user['usertype']);
                exit;
                $requestAdmin = $user['usertype'];

                if ($requestAdmin === true) {
                    $this->commentManager->getComments(); 
                    header('location: post&id_article='.$_SESSION['id_article']);
                }else{
                    header('location: accueil?login=connected');
                }
            }
             else{
                 echo('utilisateur non connecte');
                header('Location: login&user');
                }
    }

    private function updateOneComment($id_comment){
        echo('|ControllerComment. php updateOneComment');

        if(($user=Security::retrieveUserObj('MEMBRE'))!=null){ // Ok array pas obj
            $this->userManager = new userManager;
            $user = $this->userManager->ProfilUser(); // Ok obj

            //Verifie si auteur du comment autorise a update.        
            $this->commentManager = new CommentManager;
            $isAuthor = $this->commentManager->verifCommentAuthor($id_comment);
            var_dump($isAuthor);

            var_dump($S_POST);

            if(!empty($_POST) && $isAuthor = true) {
                $this->commentManager->updateComment($id_comment);
            }
        } 
    }

    private function deleteOneComment($id){
        //1 verifie si c bien lutilisateur du comment
        //2 envoyer une requete delete de l'id article       
        if(($user=Security::retrieveUserObj('MEMBER'))!=null){ //
        }   

    }

}