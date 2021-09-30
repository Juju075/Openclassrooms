<?php
namespace Entity;

class Comment 
{
 //use Timestampable
    private $_id_comment;
    private $_content;
    private $_disabled;
    private $_id_article;
    private $_id_user;

    
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
        $this->_id_comment = $id_comment;
    }

    public function setContent($content) 
    {
        $this->_content = $content;
    }
    
    public function setDisabled($disabled)
    {
        $this->_disabled = $disabled;
    }
    public function setId_article($id_article)
    {
        $this->_id_article = $id_article;
    }

    public function setId_user($id_user)
    {
        $this->_id_user = $id_user;
    }








    //Getters
    public function getId_comment() 
    { 
        return $this->_id_comment; 
    }

    public function getContent() 
    { 
        return $this->_content; 
    }

    
    public function getDisabled() 
    { 
        return $this->_disabled; 
    }
        public function getId_article() 
    { 
        return $this->_id_article; 
    }
    public function getId_user() 
    { 
        return $this->_id_user; 
    }

}
