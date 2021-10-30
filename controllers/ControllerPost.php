<?php
namespace controllers;
session_start();

use Controllers\ControllerContact;
use View\View;
use Entity\Article;
use Manager\ArticleManager;
use Manager\CommentManager;
use Tools\Security;


class ControllerPost
{
    private $_articleManager;
    private $commentManager;

    private $_view; 

    public function __construct(){
        if(isset($url) && count($url) < 1){
            throw new \Exception("Page introuvable", 1);
        }
        elseif (isset($_GET['create'])){
            $this->create(); 
        }
        elseif (isset($_GET['status']) && isset($_GET['status']) =="new"){
            $this->store();
        }   
        elseif (isset($_GET['delete'])){
            $this->delete($_GET['delete']); 
        }
        elseif (isset($_GET['update'])){
            $this->article('postUpdateRequest',null); 
        }
        elseif (isset($_GET['comment_update'])){ 
            $this->commentManager = new CommentManager;
            $id_comment = $_GET['comment_update'];
            $author = $this->commentManager->verifCommentAuthor($id_comment);
            if($author === true){
                $this->article('commentUpdateRequest',$id_comment);
            }
            else{
                $this->article(null, null);
            }
        }
        elseif (isset($_GET['comment_delete'])){
            $this->commentManager = new CommentManager;
            $id_comment = $_GET['comment_delete'];
            $author = $this->commentManager->verifCommentAuthor($id_comment);
            if($author === true){
                $this->commentManager->deleteOneComment($id_comment);
                }
            else{
                $this->article(null, null);
            }            
        }
        elseif (isset($_GET['article']) && isset($_GET['article']) =="update"){
            $id = $_GET['id_article'];
            $title =$_POST['title'];
            $content = $_POST['content'];
            $this->storeUpdate($id,$title,$content); 
        }    
        elseif (isset($_GET['validation'])){
            //id_comment
            //$this->adminCommentValidation($_GET['id_comment'],$_GET['token']); 
        }   
        elseif (isset($_GET['comment']) && isset($_GET['comment']) =="update_request"){
            $this->commentManager = new commentManager;
            $this->commentManager->storeCommentUpdate0($_POST['content'], $_GET['id_comment']);
        }     
        else{
            $this->article(null, null);
        }
    }

    private function create(){
        if($user=Security::retrieveUserObj('ADMIN') === true){
            $data = null;
            $this->_view = new View('CreatePost', 'Post');
            $this->_view->displayForm('Post',$data);
        }else{
            header('Location: accueil');
        }
    }   

    private function delete($id){
        $this->_articleManager = new ArticleManager;
        $this->_articleManager->deleteArticle($id);
        header('location: accueil');
    }


    private function store(){
        if(($user=Security::retrieveUserObj('ADMIN'))!==null){ 
                $this->_articleManager = new ArticleManager;
                $articleVerifNoDuplicate = $this->_articleManager->noDuplicatePost($_POST['title'], $_POST['content']);
               
                if ($articleVerifNoDuplicate === false){
                    if (isset($_POST)){
                        $_POST['id_user'] = $_SESSION['id_user'];
                        $article= new Article($_POST);   
                        $article = $this->_articleManager->createArticle($article); 
                        $articles = $this->_articleManager->getArticles();
                        $this->_view = new View('Accueil','Post');
                        $this->_view->generate(array('articles' =>$articles));
                        header('location; accueil');
                    }
                    else{}
                }else{
                    header('location; accueil');
                }
            }else{
            header('location: accueil');
        }
    }

    private function storeUpdate($id,$title,$content){
        if(($user=Security::retrieveUserObj('ADMIN'))!==null){
            $this->_articleManager = new ArticleManager;
            $this->_articleManager->updateArticle($id,$title,$content);
            header('location: /post&id_article='.$id); 
        }else{
            header('location: post&id_article='.$id); //pas admin
        }
    }

    private function article($routename, $id_comment){
        if(isset($_GET['id_article'])){
            $_SESSION['id_article'] = $_GET['id_article'];

            if(isset($_SESSION['routeNameForComment'])){
                $routename = $_SESSION['routeNameForComment'];
            }
            
            $this->_articleManager = new ArticleManager;
            $articleVerif = $this->_articleManager->articleVerif();

            if ($articleVerif === true ){
                $article = $this->_articleManager->getArticle($_GET['id_article']);     
                $this->commentManager = new CommentManager;
                $comments = $this->commentManager->getComments(1);
                $nbrcomments = $this->commentManager->displaynumber($comments);

                $this->_view = new View('singlePost','Post');
                $this->_view->generatePost(array('article'=>$article, 'comments'=> $comments, 'nbrcomments'=>$nbrcomments, 'routename'=>$routename,'id_comment'=>$id_comment),'PostsinglePost');
            
                if(isset($_SESSION['routeNameForComment'])){
                    unset($_SESSION['routeNameForComment']);
                }
            }
            elseif ($articleVerif === false){
                header('location: accueil');
            }else{
                header('location: accueil');
            }
        }
    }
}
