<?php
namespace Controllers;
session_start();

use View\View;

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


    public function __construct(){
        if(isset($url) && count($url) < 1){
            throw new \Exception("Page introuvable", 1);
        }else{
            $this->login();
        }      
    }


    private function login(){
         echo('ControllerAdmin.php login');
        $this->_view = new View('Login', 'Login');
        $this->_view->displayForm('Login');       
    }

    private function validationComment(){
        //verification de role
        //verification existance id_comment 
        //verification si comment deja publie 1 ou 0
        //verification id_comment (user) = validation_key
        // statut 1 bdd pour ce comment
        
    }
        private function adminCommentValidation($id_comment, $token){
        //disabled 0>1
        $this->comment = new CommentManager;
        $this->comment->validationByAdmin($id_comment, $token);


    }

  }