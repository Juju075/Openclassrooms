<?php
namespace Controllers;
session_start();


use View\View;
use Manager\ArticleManager;

 class ControllerAccueil
 {
    private $_articleManager;
    private $_view;  

    public function __construct(){
        if(isset($url) && count($url) > 1){ 
            throw new \Exception("Page introuvable", 1);
        }
        //Gestion des alerts
        //Refactoring get $attribut1 et $attribut2
        elseif(isset($_GET['register']) && isset($_GET['register']) =="created"){
            $routename = 'accueil&register=created';
            $this->articles($routename);
        }
        elseif(isset($_GET['post']) && isset($_GET['post']) =="created"){
            $routename = 'accueil&post=created';
            $this->articles($routename);
        }
        elseif(isset($_GET['passe']) && isset($_GET['passe']) =="valide"){
            $routename = 'accueil&passe=valide';
            $this->articles($routename);
        }
        elseif(isset($_GET['comment']) && isset($_GET['comment']) =="notconnected"){
            $routename = 'accueil&comment=notconnected';
            $this->articles($routename);
        }
        elseif(isset($_GET['login']) && isset($_GET['login']) =="error"){
            $routename = 'accueil&login=error';
            $this->articles($routename);
        }
        elseif(isset($_GET['register']) && isset($_GET['register']) =="error"){
            $routename = 'accueil&register=error';
            $this->articles($routename);
        }
        elseif(isset($_GET['session']) && isset($_GET['session']) =="terminated"){
            $routename = 'accueil&session=terminated';
            $this->articles($routename);
        }
        elseif(isset($_GET['post']) && isset($_GET['post']) =="exist"){
            $routename = 'accueil&post=exist';
            $this->articles($routename);
        }
        elseif(isset($_GET['message']) && isset($_GET['message']) =="sent"){
            $routename = 'accueil&message=sent';
            $this->articles($routename);
        }
        else{
            $this->articles('');  
        }
    }
    
    /**
     * Fonction d'affichage de tous les articles.
     */
    private function articles($routename){
        echo('ControllerAcceuil.php articles');

        //Repository    
        $this->_articleManager = new ArticleManager(); 
        $articles = $this->_articleManager->getArticles();
        
        //View
        $this->_view = new View('Accueil', 'Post');
        $this->_view->generate(array('routename'=>$routename, 'articles'=>$articles));
    }

}