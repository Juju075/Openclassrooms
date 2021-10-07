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


  }