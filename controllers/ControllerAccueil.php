<?php
namespace Controllers;
session_start();
var_dump($_SESSION['id_user']);

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
        else{
            $this->articles();  
        }
    }
    
    /**
     * Fonction d'affichage de tous les articles.
     */
    private function articles(){
        echo('ControllerAcceuil.php articles');
        $this->_articleManager = new ArticleManager(); 
        $articles = $this->_articleManager->getArticles();

        $this->_view = new View('Accueil', 'Post');
        $this->_view->generate(array('articles'=>$articles));
    }
}