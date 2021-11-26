<?php
namespace controllers;
session_start();

use Controllers\ControllerContact;
use View\View;
use Entity\Article;
use Manager\ArticleManager;
use Manager\CommentManager;
use Manager\UserManager;
use Tools\Security;

class ControllerPost
{
    private $_articleManager;
    private $commentManager;
    private $securedPost;
    private $_view; 

    public function __construct(){
        $securedPost = array_map( 'htmlspecialchars' , $_POST );        
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
            $id_comment = $_GET['comment_delete'];
            $this->commentManager = new CommentManager;
            $author = $this->commentManager->verifCommentAuthor($id_comment);
            if($author === true){
                $this->commentManager->deleteOneComment($id_comment);
                $this->article(null, null);
                }
            else{
                $this->article(null, null);
            }            
        }
        elseif (isset($_GET['article']) && isset($_GET['article']) =="update"){           
            $id = $_GET['id_article'];
            $title =$securedPost['title'];
            $content = $securedPost['content'];
            $this->storeUpdate($id,$title,$content); 
        }    
        elseif (isset($_GET['validation'])){
        }   
        elseif (isset($_GET['comment']) && isset($_GET['comment']) =="update_request"){
            $this->commentManager = new commentManager;
            $this->commentManager->storeCommentUpdate0($securedPost['content'], $_GET['id_comment']);
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
            header('Location: listing');
        }
    }   

    private function delete($id){

        $this->commentManager = new commentManager;
        $comments = $this->commentManager->getComments(1);
        $nbrcomments = $this->commentManager->displaynumber($comments);

        $this->_articleManager = new ArticleManager;
        $this->_articleManager->deleteArticle($id, $nbrcomments);
        header('location: listing');
    }


    private function store(){
        if(($user=Security::retrieveUserObj('ADMIN'))!==null){ 
                $securedPost = array_map( 'htmlspecialchars' , $_POST );
                $this->_articleManager = new ArticleManager;
                $articleVerifNoDuplicate = $this->_articleManager->noDuplicatePost($securedPost['title'], $securedPost['content']);
               
                if ($articleVerifNoDuplicate === false){
                    if (isset($_POST)){
                        $securedPost['id_user'] = $_SESSION['id_user'];
                        $article= new Article($securedPost);   
                        $article = $this->_articleManager->createArticle($article); 
                        $articles = $this->_articleManager->getArticles();
                        $this->_view = new View('Listing','Post');
                        $this->_view->generate(array('articles' =>$articles));
                        header('location; listing');
                    }
                    else{}
                }else{
                    header('location; listing');
                }
            }else{
            header('location: listing');
        }
    }

    private function storeUpdate($id,$title,$content){
        if(($user=Security::retrieveUserObj('ADMIN'))!==null){
            $this->_articleManager = new ArticleManager;
            $response = $this->_articleManager->updateArticle($id,$title,$content);
            header('location: post&id_article='.$id);
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
                //i auteur
                $auteur = $this->userManager = new UserManager;
                $auteur = $article->getId_user();

                $this->commentManager = new CommentManager;
                $comments = $this->commentManager->getComments(1);
                $nbrcomments = $this->commentManager->displaynumber($comments);

                $this->_view = new View('singlePost','Post');
                $this->_view->generatePost(array('article'=>$article, 'comments'=> $comments, 'nbrcomments'=>$nbrcomments, 'routename'=>$routename,'id_comment'=>$id_comment,'auteur'=>$auteur),'PostsinglePost');
            
                if(isset($_SESSION['routeNameForComment'])){
                    unset($_SESSION['routeNameForComment']);
                }
            }
            elseif ($articleVerif === false){
                header('location: listing');
            }else{
                header('location: listing');
            }
        }
    }
}
