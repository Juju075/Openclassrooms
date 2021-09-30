<?php
namespace Controllers;
session_start();
 
use Tools\Model;
use Manager\ArticleManager;
use Manager\CommentManager;


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
        echo('| ControllerTest.php testComments');
        $_SESSION['comments'] = [];
        $_SESSION['id_article'] = 69;

        $this->_testManager = new CommentManager(); 
         $_SESSION['comments'] = $this->_testManager->testGetComments();
        var_dump( $_SESSION['comments']);
    }

    public function twigImplementation(){
        echo('| ControllerAcceuil.php twigImplementation');
        require_once('views/testTwig.html.twig');
        
        
        //passer des objets à la vue
        echo('jusqu ici tout vas bien 1');


        echo $twig->render('testTwig.html.twig', ['person'=>['name'=>'Marc','age'=>'13']]);

        //envoye le tableau à la vue

    }
}