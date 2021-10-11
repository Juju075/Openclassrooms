<?php
namespace Controllers;
session_start();
 
use Tools\Model;
use Manager\ArticleManager;
use Manager\CommentManager;
use Manager\ContactManager;

//http://localhost/App_Blog_MVC/test&comment
//http://localhost/App_Blog_MVC/test&comment
//http://localhost/App_Blog_MVC/test&twig



Class ControllerTest extends Model
{

    private $_testManager;

        public function __construct(){
        //Ajouter contrainte Admin.
        if(isset($url) && count($url) < 1){
            throw new \Exception("Page introuvable", 1);
        }
        elseif (isset($_GET['article'])){
            $this->testArticles(); 
        }       
        elseif (isset($_GET['comment'])){
            $this->testComments(); 
        }
        elseif (isset($_GET['twig'])){
            $this->twigImplementation(); 
        }
         elseif (isset($_GET['image'])){
            $this->codeguyUpload(); 
        }       
        else{
            header('location: /accueuil');
        }
        
    }


    private function testArticles(){
        echo('| ControllerAcceuil.php testArticles');

        $this->_articleManager = new ArticleManager(); 
        $articles = $this->_articleManager->getArticles();
        var_dump($articles);
    }


    public function testComments(){
        //tester sur getAll()

        //tester sur getOne()
        echo('| ControllerTest.php testComments');


        $_articleManager = new ArticleManager();
        $article= $_articleManager->getArticle(118); 
        var_dump($article);

        $this->contactManager = new CommentManager;
        $comments[] = $this->contactManager->getComments();
        var_dump($comments);

         //Rendre disponible twig dans le fichier.
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../template');
        $twig = new \Twig\Environment($loader, ['cache'=> false]);
        
        // comment fait appel a la vue generate
        echo $twig->render('testTwig.html.twig',['article'=> $article, 'comments'=> $comments]);     



    }

    public function twigImplementation(){
        echo('| ControllerAcceuil.php twigImplementation');
        require_once('views/testTwig.html.twig');
        
        //Rendre disponible twig dans le fichier.
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../views');
        $twig = new \Twig\Environment($loader, ['comments'=> $comments]);  
        $twig->render('testTwig.html.twig',['cache'=> false]); //passage d'entite       
        //passer des objets à la vue
        echo('jusqu ici tout vas bien 1');


        echo $twig->render('testTwig.html.twig', ['person'=>['name'=>'Marc','age'=>'13']]);

        //envoye le tableau à la vue

    }

    public function codeguyUpload(){
        //afficher le formulaire
        readfile("views/form/registerCopy.html.twig");
        var_dump($_POST);
        var_dump($_FILES);
        var_dump($_POST['foo']);

    }

}