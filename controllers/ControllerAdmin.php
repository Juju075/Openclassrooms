<?php
namespace Controllers;
session_start();

use View\View;
use Manager\CommentManager;
use Manager\ArticleManager;
use Tools\Security;

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
        elseif(isset($_GET['validation']) && isset($_GET['validation']) =="comment"){
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


    private function adminCommentValidation($id_comment, $token){
        if(($user=Security::retrieveUserObj($_SESSION['user']['usertype']))!==null && $_SESSION['user']['usertype'] === 'ADMIN'){
            $this->commentManager = new CommentManager;
            $id_article = $this->commentManager->validationByAdmin($id_comment, $token);
                if($id_article !== null){ 
                    header('location: post&id_article='.$id_article);
                }elseif($id_article === null){
                    header('location: accueil');
                }
        }else{
            header('location: accueil');
        }
    }

    public function storeUpdate($id, $content){
        echo('ControllerPost.php  storeUpdate');
        $this->_articleManager = new ArticleManager;
        $this->_articleManager->updateArticle($id, $content);

        header('location: acceuil alert');
    }
}
