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

    // /accueil 
        public function generate($data){  
        echo('| View.php generate');
        $a = 'template.html.twig';
        var_dump($data);
        $user = 'test user';
        $articles = $data['article'][0]; // ok
        $getalert = $data['routename']; // ok

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../views');
        $twig = new \Twig\Environment($loader, ['cache'=> false]);  
        echo $twig->render($a,['getalert'=>$getalert,'user'=>$user, 'articles'=>$articles]); 
    }
    



    // detail article
    public function generatePost($data){ //tableau multidimentionnel 1article + comments
        echo('| View.php generatePost');
        $a = 'templateSingle.html.twig';

        $article = $data['article']; 
       
        $comments = $data['comments']; 
        
        $user = 'ok retour user'; 
        //var_dump($article);
        //var_dump($comments);
        //var_dump($user);

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../views');
        $twig = new \Twig\Environment($loader, ['cache'=> false]);  
        //echo $twig->render($a,$data); 
        // article ? id_user uniquement | comment foreach tts les ligns ok | user quel id_user
        echo $twig->render($a,['article'=>$article,'comments'=>$comments,'user'=>$user]); 
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
    public function displayForm($action,$data){ 
        echo('| View.php displayForm');

        $page1 = 'template'.$action.'.html.twig';
        var_dump($page1);
        
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../views');
        $twig = new \Twig\Environment($loader, ['cache'=> false]);  

        //router twig params

 
        if($action === 'Register'){
            if (!empty($data)) {
                $var = $data[0];
            }else{
              $var = '';  
            }
            echo $twig->render($page1,['var'=>$var]);
        }
        elseif($action === 'Login'){
            if (!empty($data)) {
                $var = $data[0];
            }else{
              $var = '';  
            }
            echo $twig->render($page1,['var'=>$var]);
        }
        elseif($action === 'Profile'){
            $user = $data[0];
            var_dump($user);
            echo $twig->render($page1,['user'=>$user]);
        }
        elseif($action === 'Post'){
            if (!empty($data)) {
                $var = $data[0];
            }else{
              $var = '';  
            }
            echo $twig->render($page1,['var'=>$var]);
        }
         elseif($action === 'Contact'){
            if (!empty($data)) {
                $var = $data[0];
            }else{
              $var = '';  
            }
            echo $twig->render($page1,['var'=>$var]);
        }       
        elseif($action === 'Admin'){
            if (!empty($data)) {
                $var = $data[0];
            }else{
              $var = '';  
            }
            echo $twig->render($page1,['var'=>$var]);
        }                 
        else{
        throw new \Exception("Route inconnue", 1);

        }
    }


    public function generateForm(){
        $content = $this->generateFileSimple($this->_file);
        $view = $this->generateFile('views/form/templatePost.html.twig', array('t' => $this->_t, 'content' => $content));
        echo $view;
    }


    public function generateFileSimple($file){
        if(file_exists($file)){
            require $file;
        }
    }


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
}