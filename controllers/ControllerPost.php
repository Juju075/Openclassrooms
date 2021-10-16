<?php
namespace controllers;
session_start();

use Controllers\ControllerContact;
use View\View;
use Entity\Article;
use Manager\ArticleManager;
use Manager\CommentManager;

class ControllerPost
 {
    private $_articleManager;
    private $commentManager;
    private $comment;

    private $_view; 

    public function __construct(){
        if(isset($url) && count($url) < 1){
            throw new \Exception("Page introuvable", 1);
        }
        elseif (isset($_GET['create'])){
            $this->create(); 
        }
        elseif (isset($_GET['status']) && isset($_GET['status']) =="new"){ //Traitement
            $this->store();
        }   
        elseif (isset($_GET['delete'])){
            //id_article
            $this->delete($_GET['delete']); 
        }
        elseif (isset($_GET['update'])){ //App_Blog_MVC/post&update_id=29
            $this->update($_GET['update']); 
        }
        elseif (isset($_GET['update_id'])){ //Traitement update
            $this->storeUpdate($_GET['update_id']); 
            //recuperer les valeurs du formulaire
        }
         elseif (isset($_GET['validation'])){
            //id_comment
            //$this->adminCommentValidation($_GET['id_comment'],$_GET['token']); 
        }       
        else{
            $this->article();
        }
    }

    //CRUD
    private function create(){
        if(isset($_GET['create'])){
            $data ='';
            $this->_view = new View('CreatePost', 'Post');
            $this->_view->displayForm('Post',$data); //data ok vide (dispo si besoin).
        }
    }   

    private function delete($id){
        $this->_articleManager = new ArticleManager;
        $this->_articleManager->deleteArticle($id);
        header('Location: accueil&article=deleted');
    }

    private function update($id){
        echo('ControllerPost function update()');

        //View ok template + formulaire update ok
        if(isset($_GET['update'])){
            $data ='';
            $this->_view = new View('UpdatePost', 'Post'); //construct
            $this->_view->displayForm('Update', $data);
        }        
    }

    //Traitement add article.
    // Affectation $articles pour le foreach $content

    private function store(){
        echo('| controllerPost.php store');

        //Contrainte role administrateur usertype

        
        var_dump($_POST);
        //if(isset($_)

        $this->_articleManager = new ArticleManager;
        //verification de role ok
        $adminOnly = $this->_articleManager->roleverif();
        if($adminOnly === true){
             //verification si existe deja ok
             $articleVerifNoDuplicate = $this->_articleManager->articleAlreadyExist($_POST['title'], $_POST['content']);
     
             if ($articleVerifNoDuplicate === false) {
                 if (isset($_POST)){
                     $_POST['id_user'] = $_SESSION['id_user'];
                     var_dump($_POST); //verification insertion
     
                     $article= new Article($_POST);   
                     $this->_articleManager = new ArticleManager;
                     $article = $this->_articleManager->createArticle($article); //null
     
                     var_dump($article);
     
                     $articles = $this->_articleManager->getArticles();
                     $this->_view = new View('Accueil','Post');
                     $this->_view->generate(array('articles' =>$articles));
     
                 }else {
                     header('location; accueil');
                 }
             }
            else{
                echo('Alert pas autosi a effectuer cette action.');
            }
        }



    }

    //Use TemplateSingle.html.twig
    private function article(){
        echo('ControllerPost.php  article');

        if(isset($_GET['id_article'])){
            $_SESSION['id_article'] = $_GET['id_article'];

            $this->_articleManager = new ArticleManager;
            $articleVerif = $this->_articleManager->articleVerif();

            if ($articleVerif == true ){
                //Return Post
                $article = $this->_articleManager->getArticle($_GET['id_article']);

                //Return Comments        
                $this->commentManager = new CommentManager;
                $comments = $this->commentManager->getComments();  // array string

                //echo view
                $this->_view = new View('singlePost','Post');
                //$this->_view->generatePost(array('article'=>$article)); //echo $view;
                $this->_view->generatePost(array('article'=>$article, 'comments'=> $comments),'PostsinglePost'); //echo $view;
            }
            elseif ($articleVerif == false){
                header('location: accueil');
            }else{
                header('location: accueil');
            }
        }
    }
}