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
    public function __construct($action, $dossier){
        $this->_file = 'views/'.$dossier.'/view'.$action.'.html.twig';
        $this->b = $dossier.'/view'.$action.'.html.twig';
    }


    public function generate($data){  
        $a = 'template.html.twig';

        //route
        if(!empty($data['routename'])){
            $getalert = $data['routename'];
        }else{
            $getalert = null;
        }
        //articles
        if(!empty($data['articles'])){
            $articles = $data['articles'];
        }
        else{
            $articles = null;
        }
        if(!empty($_SESSION['user']['usertype'])){
            $user = $_SESSION['user']['usertype'];
        }
        else{
            $user = null;
        }
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../views');
        $twig = new \Twig\Environment($loader, ['cache'=> false]);  
        echo $twig->render($a,['getalert'=>$getalert,'user'=>$user, 'articles'=>$articles]); 
    }
    
    public function generatePost($data){ 
        $a = 'templateSingle.html.twig';
        $article = $data['article'][0];  
        $count =  $data['nbrcomments'];

        if($count != 0){
            $comments = $data['comments'];
        }else{
            $comments =null;
        }
        if(!empty($_SESSION['user']['usertype'])){
            $user = $_SESSION['user']['usertype'];
        }
        else{
            $user = null;
        }
        if(!empty($data['id_comment'])){
            $id_comment = $data['id_comment'];
        }
        else{
            $id_comment = null;
        }        
        if(!empty($data['routename'])){
            $getalert = $data['routename'];
        }else{
            $getalert = null;
        }    

        $routename = $data['routename'];
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../views');
        $twig = new \Twig\Environment($loader, ['cache'=> false]);  
        echo $twig->render($a,['article'=>$article,'comments'=>$comments,'user'=>$user,'count'=>$count,'routename'=>$routename,'id_comment'=>$id_comment,'getalert'=>$getalert]); 
    }

    public function simpleContent($action){ 
        $page = 'views/template'.$action .'.html.twig';
        $view = $this->generateFileSimple($page);
        echo $view;
    }

    public function displayForm($action,$data){ 
        $page1 = 'template'.$action.'.html.twig';
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../views');
        $twig = new \Twig\Environment($loader, ['cache'=> false]);  
        
        if(!empty($_SESSION['user']['usertype'])){
            $user = $_SESSION['user']['usertype'];
        }   


        if($action === 'Register'){
            if (!empty($data)) {
                $var = $data[0];
            }else{
              $var = null;  
            }
            echo $twig->render($page1,['var'=>$var]);
        }
        elseif($action === 'Login'){
            if (!empty($data)) {
                $var = $data[0];
            }else{
              $var = null;  
            }
            echo $twig->render($page1,['var'=>$var]);
        }
        elseif($action === 'Profile'){
            $user = $data;
            echo $twig->render($page1,['user'=>$user]);
        }
        elseif($action === 'Post'){
            if (!empty($data)) {
                $var = $data[0];
            }else{
              $var = null;  
            }
            echo $twig->render($page1,['var'=>$var]);
        }
         elseif($action === 'Contact'){
            if (!empty($data)) {
                $var = $data[0];
            }else{
              $var = null;  
            }
            echo $twig->render($page1,['var'=>$var]);
        }       
        elseif($action === 'Update'){
            if (!empty($data)) {
                $var = $data[0];
            }else{
              $var = null;  
            }
            echo $twig->render($page1,['var'=>$var]);
        }
        elseif($action === 'Admin'){
            if (!empty($data)) {
                var_dump($data);

                $articles = $data[0]['article'];
                var_dump($articles);
                exit;

                $comments = $data['comments'];
                var_dump($comments);
                $urls = $data['urls'];
                echo $twig->render($page1,['user'=>$user,'articles'=>$articles, 'comments'=>$comments,'urls'=>$urls]);
            }else{
              $var = null;  
              echo $twig->render($page1,['var'=>$var]);
            }
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
