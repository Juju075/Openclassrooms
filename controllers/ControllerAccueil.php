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


        elseif (isset($_GET['acceuil']) && isset($_GET['login']) =="notconnected"){  
            $this->$this->articles(1);       
        }  
        elseif (isset($_GET['acceuil']) && isset($_GET['login']) =="connected"){  
            $this->$this->articles(2);       
        }  
        elseif (isset($_GET['acceuil']) && isset($_GET['register']) =="created"){  
            $this->$this->articles(3);       
        }  
        elseif (isset($_GET['acceuil']) && isset($_GET['post']) =="created"){  
            $this->$this->articles(4);       
        }  
        elseif (isset($_GET['acceuil']) && isset($_GET['passe']) =="valide"){  
            $this->$this->articles(5);       
        }  
        elseif (isset($_GET['acceuil']) && isset($_GET['comment']) =="notconnected"){  
            $this->$this->articles(6);       
        }  
        elseif (isset($_GET['acceuil']) && isset($_GET['login']) =="error"){  
            $this->$this->articles(7);       
        }  
        elseif (isset($_GET['acceuil']) && isset($_GET['post']) =="created"){  
            $this->$this->articles(8);       
        }  
        elseif (isset($_GET['acceuil']) && isset($_GET['session']) =="terminated"){  
            $this->$this->articles(9);       
        }  
        elseif (isset($_GET['acceuil']) && isset($_GET['message']) =="send"){  
            $this->$this->articles(10);       
        }   


        else{
            $this->articles(0);  
        }
    }
    
    /**
     * Fonction d'affichage de tous les articles.
     */
    private function articles($alertnumb){
        echo('ControllerAcceuil.php articles');

        $this->_articleManager = new ArticleManager(); 
        $articles = $this->_articleManager->getArticles();
        
        //Affectation de comments


        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../views');
        $twig = new \Twig\Environment($loader, ['cache'=> false]);  
        //get numero alert 
        echo $twig->render('/Post/viewAcceuil.html.twig',$alertnumb);

        $this->_view = new View('Accueil', 'Post');
        $this->_view->generate(array('articles'=>$articles));

        //si besoin quel alert affiche. 0-8
    }

}