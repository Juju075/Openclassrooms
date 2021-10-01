<?php
namespace controllers;
session_start();

use View\View;
use Entity\Article;
use Manager\ArticleManager;
use Manager\CommentManager;

class ControllerPost
 {
    private $_articleManager;
    private $_commentManager;

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
            $this->delete($_GET['delete']); 
        }
        elseif (isset($_GET['update'])){ //App_Blog_MVC/post&update_id=29
            $this->update($_GET['update']); 
        }
        elseif (isset($_GET['update_id'])){ //Traitement update
            // methode post
            $this->storeUpdate($_GET['update_id']); 
            //recuperer les valeurs du formulaire
        }
        else{
            $this->article();
        }
    }

    //CRUD
    private function create(){
        if(isset($_GET['create'])){
            $this->_view = new View('CreatePost', 'Post');
            $this->_view->displayForm('Post');
        }
    }   

    private function delete($id){
        $this->_articleManager = new ArticleManager;
        $this->_articleManager->deleteArticle($id);
        header('Location: accueil');
    }


    private function update($id){
        echo('ControllerPost function update()');

        //View ok template + formulaire update ok
        if(isset($_GET['update'])){
            
            $this->_view = new View('UpdatePost', 'Post'); //construct
            $this->_view->displayForm('Update');
        }        
    }
    

    private function noDuplicate(){

        // bdd all title comparatif avec la nouvelle saisie titre
         //si titre existe deja
        $title = $_POST['title'];
        //getAlltitle

        //cpt le nombre de ligne
        //Boucle de verification
        //while
        //check if title = $title
        //bool 0 $this->store() 1 Alerte rouge c article existe deja


        
    }

    //Traitement add article.
    // Affectation $articles pour le foreach $content


    private function store(){
    echo('controllerPost.php function store');
        if (isset($_POST)){
            $article= new Article($_POST);
            $this->_articleManager = new ArticleManager;
            $article = $this->_articleManager->createArticle($article);
            $articles = $this->_articleManager->getArticles();
            $this->_view = new View('Accueil','Post');
            $this->_view->generate(array('articles' =>$articles));
        }
    }


    public function storeUpdate($id){
        echo('ControllerPost.php  storeUpdate()');

        //BDD 
        $this->_articleManager = new ArticleManager;
        $this->_articleManager->updateArticle($id);


        //une fois fini script
        //header('Location: App_Blog_MVC/accueil');
}


    private function article(){
        echo('ControllerPost.php  article()');
        if(isset($_GET['id_article'])){
            $_SESSION['id_article'] = $_GET['id_article'];

            $this->_articleManager = new ArticleManager;
            $article = $this->_articleManager->getArticle($_GET['id_article']);
            
            $this->_view = new View('singlePost','Post');
            $this->_view->generatePost(array('article'=>$article));


            //Recuperer la liste des comments.
            $this->_commentManager = new CommentManager;
            $_SESSION['comments'] = $this->_commentManager->testGetComments();
            var_dump($_SESSION['comments']);
        }
    }
}