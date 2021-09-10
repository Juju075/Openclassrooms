<?php

class View
{
    private $_file;
    private $_t;

    function __construct($action, $dossier){
        $this->_file = 'views/'.$dossier.'/view'.$action.'.php';
    }

    public function generate($data){   
        $content = $this->generateFile($this->_file, $data);

        $view = $this->generateFile('views/template.php', array('t' => $this->_t, 'content' => $content));
        echo $view;
    }

    //il gen
    public function generatePost($data){
        $content = $this->generateFile($this->_file,$data);

        $view = $this->generateFile('views/templateSingle.php', array('t'=>$this->_t, 'content'=>$content));
        echo $view;
    }

    public function displayForm($action){ 
        $page = 'views/template'.$action .'.php';
        $view = $this->generateFileSimple($page);
        echo $view;
    }

    public function simpleContent($action){ 
        $page = 'views/template'.$action .'.php';

        
        $view = $this->generateFileSimple($page);
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

  public function generateForm(){
    $content = $this->generateFileSimple($this->_file);
    $view = $this->generateFile('views/form/templatePost.php', array('t' => $this->_t, 'content' => $content));
    echo $view;
  }

}