<?php
namespace Controllers;

use View\View;
use Manager\ArticleManager;


//require_once('models/Manager/ArticleManager.php'); // à enlever bizarre

/**
 *require_once 'views/View.php';
* require_once('models/Manager/ArticleManager.php'); // à enlever bizarre
 */


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
        
    private function articles(){
        $this->_articleManager = new ArticleManager(); 
        $articles = $this->_articleManager->getArticles();

        $this->_view = new View('Accueil', 'Post');
        $this->_view->generate(array('articles'=>$articles));
    }
}