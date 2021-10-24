<?php
namespace View;

class View
{
    private $_file; //
    private $_t; //
    private $a;
    private $b;

    /**
     * Affecte le nom du fichier $_file eg:viewAccueil.php
     */
    function __construct($action, $dossier){
        $this->_file = 'views/'.$dossier.'/view'.$action.'.html.twig';
        $this->b = $dossier.'/view'.$action.'.html.twig';
    }

    //GENERATE PAGE $content
        public function generate($data){  
        echo('| View.php generate');
        var_dump($data);

        $content = $this->generateFile($this->_file,$data);
        // {% include 'Post/viewSinglePost.html copy.twig' %} vas aussi recuperer le html et on passe les data directment
        // dans la page en 

        $view = $this->generateFile('views/template.html.twig', array('t' => $this->_t,'content' => $content));
        echo $view;

        //if content empty page erreur.
    }


    /**
     * Cette fonction sert à generer le listing des Post (All). template.php 
     */
    public function generateBackup($data){  
        echo('| View.php generate');

        $content = $this->generateFile($this->_file,$data);
        $view = $this->generateFile('views/template.html.twig', array('t' => $this->_t,'content' => $content));
        echo $view;

        //if content empty page erreur.
    }


    // COPIE - Injection de Twig
    public function generatePost($data){ //tableau multidimentionnel 1article + comments
        echo('| View.php generatePost');
        $a = 'templateSingle.html.twig';

        $content = $this->generateFile($this->_file,$data); //retourne du htl

        $article = $data['article']; 
        var_dump($article);
        $comments = $data['comments']; 
        $user = 'ok retour user'; 

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../views');
        $twig = new \Twig\Environment($loader, ['cache'=> false]);  
        //echo $twig->render($a,$data); 
        echo $twig->render($a,['content'=>$content,'article'=>$article,'comments'=>$comments,'user'=>$user]); 

        //$echo1 = $this->generateFile('views/'.$a, array('t'=>$this->_t, 'content'=>$content)); 
    }



    /**
     * Cette fonction sert generer la page de detail Post(One). templateSingle.php
     * Injecte du twig
     */
    public function generatePostBackup($data){
        echo('| View.php generatePost');
        $content = $this->generateFile($this->_file,$data);
        $view = $this->generateFile('views/templateSingle.html.twig', array('t'=>$this->_t, 'content'=>$content));  
        echo $view;
    }



    /**
     * pas appeler a voir. 
     * Cette fonction sert à 
     */
    public function simpleContent($action){ 
        $page = 'views/template'.$action .'.html.twig';
        $view = $this->generateFileSimple($page);
        echo $view;
    }

    /**
     * Cette fonction sert à afficher le formulaire souhaité.
     * views/template
     */
    public function displayForm($action){ 
        echo('| View.php displayForm');

        //issue multipages
        //$page = 'views/template'.$action .'.html.twig';
        $pagecopy = 'views/template'.$action .'Copy'.'.html.twig';

        $page1 = 'template'.$action .'Copy'.'.html.twig';
        var_dump($page1);

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../views');
        $twig = new \Twig\Environment($loader, ['cache'=> false]);  

        //$view = $this->generateFileSimple($pagecopy); //$page  verifie et require
        //echo $view;

        $ici = 'ok loader twig';
        echo $twig->render($page1,['ici'=>$ici]); 
        // correction faudrait template.html.twig {{ include $action .'.html.twig'}}
    }

     /**
     * Cette fonction sert à 
     */
    public function generateForm(){
        $content = $this->generateFileSimple($this->_file);
        $view = $this->generateFile('views/form/templatePost.html.twig', array('t' => $this->_t, 'content' => $content));
        echo $view;
    }
    //Call 
    /**
     * Cette fonction sert à ajouter un require variable.
     */
    public function generateFileSimple($file){
        if(file_exists($file)){
            require $file;
        }
    }

    /**
     * Cette fonction sert mise en tampon des datas.
     */
    private function generateFile($file, $data){  
        if(file_exists($file)){
            extract($data); 
            ob_start();
            require $file;
            return ob_get_clean();
        }
        else{
        throw new \Exception("Fichier".$file." introuvable", 1);
        }
    }

    /**
     * Cette fonction sert à 
     */
    public function displayFormUpdate(){
        
    }

}