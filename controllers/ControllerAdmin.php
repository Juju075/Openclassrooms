<?php
namespace Controllers;
session_start();

use View\View;
use Manager\CommentManager;

/**
 * Toute les fonctionnalites
 * postManagement()
 * addPost()
 * deletePost()
 * postEdit()
 * updatePost()
 * usersManagement()
 * enableComment()
 * deleteComment()
 */

 /**
  * routes
  * login
  *
  */

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
        else{
           //$this->login();
    }
}


    private function login(){
        echo('ControllerAdmin.php login');
        $data = '';
        $this->_view = new View('Login', 'Login');
        $this->_view->displayForm('Login', $data);       
    }

    //retour du lien de validation
    private function adminCommentValidation($id_comment, $token){
    echo('ControllerAdmin.php adminCommentValidation');

    $this->comment = new CommentManager;
    $validation = $this->comment->validationByAdmin($id_comment, $token);
exit;
    //View  Alert le commentaire utilisateur est ajouté!!!
    $this->_view = new View('','');
    $this->view->displayForm('Admin',$data);



    }

  }