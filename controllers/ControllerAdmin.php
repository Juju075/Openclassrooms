<?php
namespace Controllers;
session_start();

use View\View;
use Manager\CommentManager;
use Manager\ArticleManager;

class ControllerAdmin
{
    private $adminManager;
    private $_view;
    private $commentManager;
    private $userManager;


    public function __construct(){
        if(isset($url) && count($url) < 1){
            throw new \Exception("Page introuvable", 1);
        }    
        elseif(isset($_GET['validation']) && isset($_GET['validation']) =="comment"){ //admin&validation=comment&id=75&token=63aee5f60929e7e2aac8b25a3e826f0e
            $id_comment = $_GET['id'];
            $token = $_GET['token'];
                $this->adminCommentValidation($id_comment,$token);
        }
          elseif (isset($_GET['login'])){ //admin&login
            $this->login();       
        }             
        else{
           $this->login();
        }
    }

    private function login(){
        echo('ControllerAdmin.php login');
        $data = '';
        $this->_view = new View('Login', 'Admin');
        $this->_view->displayForm('Login', $data);       
    }

    //retour du lien de validation
    private function adminCommentValidation($id_comment, $token){
    echo('|ControllerAdmin.php adminCommentValidation');

    $this->comment = new CommentManager;
    $validation = $this->comment->validationByAdmin($id_comment, $token);
    if($validation === true){
    }else{
        header('location: accueil alert');       
    }
    header('location: accueil alert');
    }


    public function storeUpdate($id, $content){
        echo('ControllerPost.php  storeUpdate');
        $this->_articleManager = new ArticleManager;
        $this->_articleManager->updateArticle($id, $content);

        header('location: acceuil alert');
    }
}
