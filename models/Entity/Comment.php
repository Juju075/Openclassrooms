<?php
namespace Entity;

class Comment 
{
 //use Timestampable
    private $id_comment;
    private $content;
    private $disabled;
    private $id_article;
    private $id_user;

    
    public function __construct(array $data){
        $this->hydrate($data);
    }


    public function hydrate(array $data)
    {
        foreach ($data as $key => $value){
            $method = 'set'.ucfirst($key);  //function setContent  (attribut est la clé data est la valeur.)

            if(method_exists($this, $method)) 
            {  
                $this->$method($value);
            }
        }
    }


    
    //Setters
    public function setId_comment($id_comment) 
    {
        $this->id_comment = $id_comment;
    }

    public function setContent($content) 
    {
        $this->content = $content;
    }
    
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
    }
    public function setId_article($id_article)
    {
        $this->id_article = $id_article;
    }

    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
    }



    //Getters
    public function getId_comment() 
    { 
        return $this->id_comment; 
    }
    public function getContent() 
    { 
        return $this->content; 
    }
    public function getDisabled() 
    { 
        return $this->disabled; 
    }
        public function getId_article() 
    { 
        return $this->id_article; 
    }
    public function getId_user() 
    { 
        return $this->id_user; 
    }
}
