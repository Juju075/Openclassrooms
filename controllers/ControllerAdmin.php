<?php
namespace Controllers;
session_start();

use View\View;
 
use Manager\CommentManager;
use Manager\ArticleManager;
use Manager\AdminManager;
use Manager\UserManager;
use Tools\Security;

class ControllerAdmin
{
    private $_view;
    private $commentManager;
    private $articleManager;
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
        elseif(isset($_GET['comments']) && isset($_GET['comments']) == 'validation'){
            $this->dashboard();
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
    
    public function dashboard(){
        if(($user=Security::retrieveUserObj('ADMIN'))!==null){         
        $this->adminManager = new AdminManager;
        $countarticles = $this->adminManager->countEntity('Articles', null);

        $this->adminManager = new AdminManager;
        $countcomments1 = $this->adminManager->countEntity('Comments',1);    
        
        $countcomments0 = $this->adminManager->countEntity('Comments',0);   

        $this->adminManager = new AdminManager;
        $countusers = $this->adminManager->countEntity('Users', null); 

        $data =$this->adminManager->commentsToValide();

        // $listIdUsers[] =null;
        // $this->userManager = new UserManager;
        // $allusersname = $this->userManager->getFullName($listIdUsers); // select prenom nom boulce de rech par id_user
    

        $this->_view = new View('singlePost','Admin');
        $this->_view->displayForm('Admin',array('countarticles'=>$countarticles,'countcomments1'=>$countcomments1,'countcomments0'=>$countcomments0,'countusers'=>$countusers));        
        }
    }


    public function allValidationsRequest(){
        if(($user=Security::retrieveUserObj('ADMIN'))!==null){ 

        $this->articleManager = new ArticleManager(); 
        $article = $this->articleManager->getArticles();

        $this->commentManager = new CommentManager;
        $comments = $this->commentManager->getComments(0);

        //urls
        $this->moderatorManager = new CommentManager;
        $this->moderatorManager->getUrls();
        $urls =null;

        $id_comment = null;

        $this->_view = new View('Admin','Admin');
        $this->_view->generateAdmin(array('article'=>$article, 'comments'=> $comments, 'urls'=>$urls,'id_comment'=>$id_comment));
        }
    } //delete

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
