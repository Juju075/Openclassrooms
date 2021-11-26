<?php
namespace Controllers;
session_start();


use View\View;
use Manager\ArticleManager;

 class ControllerListing
 {
    private $_articleManager;
    private $_view;  

    public function __construct(){
        if(isset($url) && count($url) > 1){ 
            throw new \Exception("Page introuvable", 1);
        }
        elseif(isset($_GET['register']) && isset($_GET['register']) =="created"){
            $routename = 'listing&register=created';
            $this->articles($routename);
        }
        elseif(isset($_GET['post']) && isset($_GET['post']) =="created"){
            $routename = 'listing&post=created';
            $this->articles($routename);
        }
        elseif(isset($_GET['passe']) && isset($_GET['passe']) =="valide"){
            $routename = 'listing&passe=valide';
            $this->articles($routename);
        }
        elseif(isset($_GET['comment']) && isset($_GET['comment']) =="notconnected"){
            $routename = 'listing&comment=notconnected';
            $this->articles($routename);
        }
        elseif(isset($_GET['login']) && isset($_GET['login']) =="error"){
            $routename = 'listing&login=error';
            $this->articles($routename);
        }
        elseif(isset($_GET['register']) && isset($_GET['register']) =="error"){
            $routename = 'listing&register=error';
            $this->articles($routename);
        }
        elseif(isset($_GET['session']) && isset($_GET['session']) =="terminated"){
            $routename = 'listing&session=terminated';
            $this->articles($routename);
        }
        elseif(isset($_GET['post']) && isset($_GET['post']) =="exist"){
            $routename = 'listing&post=exist';
            $this->articles($routename);
        }
        elseif(isset($_GET['message']) && isset($_GET['message']) =="sent"){
            $routename = 'listing&message=sent';
            $this->articles($routename);
        }
        else{
            $this->articles('');  
        }
    }
    
    private function articles($routename){   
        $this->_articleManager = new ArticleManager(); 
        $articles = $this->_articleManager->getArticles();

        $this->_view = new View('Listing', 'Post');
        $this->_view->generate(array('routename'=>$routename, 'articles'=>$articles, 'template'=>'templateListing.html.twig'));
    }
}
