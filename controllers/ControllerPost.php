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
            // methode post
            $this->storeUpdate($_GET['update_id']); 
            //recuperer les valeurs du formulaire
        }
         elseif (isset($_GET['validation'])){
            //id_comment
            $this->adminCommentValidation($_GET['id_comment'],$_GET['token']); 
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
    

    //Traitement add article.
    // Affectation $articles pour le foreach $content


    private function store(){
        echo('| controllerPost.php store');

        //Contrainte role administratue usertype
        //1 rch usertype si usertype === 1 sinon alert
   
        var_dump($_POST);

        $this->_articleManager = new ArticleManager;
        $articleVerifNoDuplicate = $this->_articleManager->articleAlreadyExist($_POST['title'], $_POST['content']);

        if ($articleVerifNoDuplicate === false) {
            if (isset($_POST)){
                $id_user = 1; // getIdUser() ou par defaut.
                $_POST['id_user'] = $id_user;
                var_dump($_POST);

                $article= new Article($_POST);   
                var_dump($article); 
                $this->_articleManager = new ArticleManager;
                $article = $this->_articleManager->createArticle($article);
                $articles = $this->_articleManager->getArticles();
                $this->_view = new View('Accueil','Post');
                $this->_view->generate(array('articles' =>$articles));
            }else {
                header('location; accueil');
            }
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
            $articleVerif = $this->_articleManager->articleVerif();

            if ($articleVerif == true ){
                $article = $this->_articleManager->getArticle($_GET['id_article']);
                $this->commentManager = new CommentManager;
                var_dump($article); // object(Entity\Article)[8]

                $comments = $this->commentManager->getComments();  // array string
                echo('comment');
                var_dump($comments);
                //$_SESSION['comments'] = $this->commentManager->getComments(); //supprimer cette ligne

                //Vue

                $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../views');
                $twig = new \Twig\Environment($loader, ['cache'=> false]);  

                $commentManager = new CommentManager();
                $comments= $this->commentManager->getComments($_GET['id_article']); 

                //echo $twig->render('/Comment/listComments.html.twig',['article'=> $article]);


                $this->_view = new View('singlePost','Post');
                $this->_view->generatePost(array('article'=>$article));

            }
            elseif ($articleVerif == false){
                header('location: accueil');
            }else{
                header('location: accueil');
            }
        }
    }
    
    private function adminCommentValidation($id_comment, $token){
        //disabled 0>1
        $this->comment = new CommentManager;
        $this->comment->validationByAdmin($id_comment, $token);


    }
}