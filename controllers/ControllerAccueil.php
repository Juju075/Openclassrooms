<?php
namespace Controllers;
session_start();


use View\View;
use Manager\ArticleManager;

 class ControllerAccueil
 {
    private $_presentationManager;
    private $_view;  

    public function __construct(){
        if(isset($url) && count($url) > 1){ 
            throw new \Exception("Page introuvable", 1);
        }else{
            $this->presentation();  
        }
    }


    public function presentation()
    {
        $this->_view = new View('Accueil', 'Post');
        $this->_view->generate(null);
    }
 }