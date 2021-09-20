<?php
namespace controllers;

use View\View;
use Manager\ArticleManager;

 class ControllerPost
 {
    private $_articleManager;
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
        elseif (isset($_GET['update'])){
            $this->update($_GET['update']); 
        }
        elseif (isset($_GET['update_id']) && isset($_GET['update_id']) =="numeroid"){ //Traitement
            $this->store(); 
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

        //View
        if(isset($_GET['update'])){
            
            $this->_view = new View('UpdatePost', 'Post'); //construct
            $this->_view->displayForm('Update');
        }        

        //BDD 
        $this->_articleManager = new ArticleManager;
        $this->_articleManager->updateArticle($id);

        //une fois fini script
        //header('Location: App_Blog_MVC/accueil');
    }
    




    //Creation d'un article.
    private function store(){
        
        $this->_articleManager = new ArticleManager;
        $article = $this->_articleManager->createArticle();
        $articles = $this->_articleManager->getArticles();

        $this->_view = new View('Accueil','Post');
        $this->_view->generate(array('articles' =>$articles));
    }

    private function article(){
        if(isset($_GET['id_article'])){
            $this->_articleManager = new ArticleManager;
            $article = $this->_articleManager->getArticle($_GET['id_article']);

            $this->_view = new View('singlePost','Post');
            $this->_view->generatePost(array('article'=>$article));
        }
    }

}