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
            //id_article
            $this->delete($_GET['delete']); 
        }
        elseif (isset($_GET['update'])){ //Admin only
            $this->article('postUpdateRequest',null); 
        }
        elseif (isset($_GET['comment_update'])){ //Show update form below article. Admin
            $this->commentManager = new CommentManager;
            $id_comment = $_GET['comment_update'];
            $author = $this->commentManager->verifCommentAuthor($id_comment);
            if($author == true){
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
            if($author == true){
                $this->commentManager->deleteOneComment('comment', $id_comment);
                }
            else{
                $this->article(null, null);
            }            
        }
        elseif (isset($_GET['article']) && isset($_GET['article']) =="update"){ //Traitement update
            $this->storeUpdate($_POST); 
        }    
         elseif (isset($_GET['validation'])){
            //id_comment
            //$this->adminCommentValidation($_GET['id_comment'],$_GET['token']); 
        }       
        else{
            $this->article(null, null);
        }
    }

    

    //CRUD
    private function create(){
            $data ='';
            $this->_view = new View('CreatePost', 'Post');
            $this->_view->displayForm('Post',$data); //data ok vide (dispo si besoin).
    }   

    private function delete($id){
        $this->_articleManager = new ArticleManager;
        $this->_articleManager->deleteArticle($id);
        header('Location: accueil&article=deleted');
    }

    private function store(){
        if(($user=Security::retrieveUserObj('ADMIN'))!=null){ // return boll
            //user->getid_User(); // Expected type 'object'. Found 'bool'
                $this->_articleManager = new ArticleManager;
                $articleVerifNoDuplicate = $this->_articleManager->articleAlreadyExist($_POST['title'], $_POST['content']);
               
                if ($articleVerifNoDuplicate === false){
                    if (isset($_POST)){
                        $_POST['id_user'] = $_SESSION['id_user'];
                        //Ajout Id_user 
                        $article= new Article($_POST);   
                        $article = $this->_articleManager->createArticle($article); 
                        $articles = $this->_articleManager->getArticles();
                        $this->_view = new View('Accueil','Post');
                        $this->_view->generate(array('articles' =>$articles));
                        header('location; accueil');//sucess
                    }
                    else{}
                }else{
                    header('location; accueil');// article already exist
                }
            }else{
            header('location: accueil'); //not admin
        }
    }

    private function storeUpdate($data){
        $this->_articleManager = new ArticleManager;
        $this->_articleManager->updateArticle($data);
        header('location: post&id_article='.$_SESSION['id_article']);
    }

    //Use TemplateSingle.html.twig
    private function article($routename, $id_comment){
        if(isset($_GET['id_article'])){
            $_SESSION['id_article'] = $_GET['id_article'];
            
            $this->_articleManager = new ArticleManager;
            $articleVerif = $this->_articleManager->articleVerif();

            if ($articleVerif == true ){
                //Return Post
                $article = $this->_articleManager->getArticle($_GET['id_article']);
                //Return Comments        
                $this->commentManager = new CommentManager;
                $comments = $this->commentManager->getComments();
                $nbrcomments = $this->commentManager->displaynumber($comments);

                //View
                $this->_view = new View('singlePost','Post');
                $this->_view->generatePost(array('article'=>$article, 'comments'=> $comments, 'nbrcomments'=>$nbrcomments, 'routename'=>$routename,'id_comment'=>$id_comment),'PostsinglePost');
            }
            elseif ($articleVerif == false){
                header('location: accueil');
            }else{
                header('location: accueil');
            }
        }
    }
}