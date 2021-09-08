<?php 
/**
 * 
 */
class Article
{

    private $_id_article;
    private $_title;
    private $_content;
    private $_date;

    //verifie ds video si il a mis incrementation pour ID
    
    //Model.php $data = $req->fetch(PDO::FETCH_ASSOC)   
    public function __construct(array $data){
        $this->hydrate($data);
    }


    public function hydrate(array $data){
        foreach ($data as $key => $value){
            $method = 'set'.ucfirst($key);  

            if(method_exists($this, $method)) {  
                $this->$method($value);
            }
        }
    }
 

    public function setId($id_article){  
        $id = (int) $id_article;
        if ($id > 0){
            $this->_id_article = $id_article;
        }
    }
    public function setTitle($title){
        if(is_string($title)){
            $this->_title = $title;
        }
    }
    public function setContent($content){
        if(is_string($content)){
            $this->_content = $content;
        }
    }
     public function setDate($date){
            $this->_date = $date;
    }
 

    public function Id_article(){
        return $this->echo();
        //return $this->_id_article;
    }
    //debuging
    public function echo(){
        echo(17);
    }

    public function Title(){
        return $this->_title;
    }    
    public function Content(){ 
        return $this->_content;
    }
    public function Date(){
        return $this->_date;
    }
}