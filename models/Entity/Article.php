<?php 
namespace Entity;

class Article
{

    private $_id_article;
    private $_content;
    private $_chapo;
    private $_title;


    //verifie ds video si il a mis incrementation pour ID
    
    //Model.php $data = $req->fetch(PDO::FETCH_ASSOC)   
    public function __construct(array $data){
        $this->hydrate($data);
    }


    public function hydrate(array $data)
    {
        foreach ($data as $key => $value){
            $method = 'set'.ucfirst($key);  

            if(method_exists($this, $method)) 
            {  
                $this->$method($value);
            }
        }
    }
 

    //Setters
    public function setId(?int $id_article)
    {  
        $id = (int) $id_article;
        if ($id > 0){
            $this->_id_article = $id_article;
        }
    }

    public function setTitle(?string $title) 
    {
        if(is_string($title)){
            $this->_title = $title;
        }
    }

    public function setContent(?string $content) 
    {
        if(is_string($content)){
            $this->_content = $content;
        }
    }

    

    //Getters
    public function getId_article()
    {
        //function lance mais null
        //return echo($this->_id_article);;
        //return $this->_id_article;
        echo('45');
    }
    


    public function getChapo() 
    {
    echo('resume ici ok');
        //return $this->_chapo;
    }


    
    public function getTitle(): ?string
    {
        return $this->_title;
    }    


    
    public function getContent(): ?string
    { 
        return $this->_content;
    }
    
    //here Foreign key
}