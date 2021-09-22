<?php
namespace View;

class View
{
    private $_file; //
    private $_t; //

    /**
     * Affecte le nom du fichier $_file eg:viewAccueil.php
     */
    function __construct($action, $dossier){
        $this->_file = 'views/'.$dossier.'/view'.$action.'.php';
    }



    //GENERATE PAGE $content

    /**
     * Cette fonction sert à generer le listing des Post (All). template.php 
     */
    public function generate($data){  
        $content = $this->generateFile($this->_file,$data);
        $view = $this->generateFile('views/template.php', array('t' => $this->_t, 'content' => $content));
        echo $view;
    }

    /**
     * Cette fonction sert generer la page de detail Post(One). templateSingle.php
     */
    public function generatePost($data){
        $content = $this->generateFile($this->_file,$data);
        $view = $this->generateFile('views/templateSingle.php', array('t'=>$this->_t, 'content'=>$content));
        echo $view;
    }






    /**
     * pas appeler a voir. 
     * Cette fonction sert à 
     */
    public function simpleContent($action){ 
        $page = 'views/template'.$action .'.php';
        $view = $this->generateFileSimple($page);
        echo $view;
    }

    /**
     * Cette fonction sert à afficher le formulaire souhaité.
     * views/template
     */
    public function displayForm($action){ 
        $page = 'views/template'.$action .'.php';
        $view = $this->generateFileSimple($page);
        echo $view;
    }

     /**
     * Cette fonction sert à 
     */
    public function generateForm(){
        $content = $this->generateFileSimple($this->_file);
        $view = $this->generateFile('views/form/templatePost.php', array('t' => $this->_t, 'content' => $content));
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
     * generate($data) generatePost($data)
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