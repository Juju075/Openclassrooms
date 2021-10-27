<?php 
namespace Entity;

class Article
{

    private $id_article;
    private $title;
    private $chapo;
    private $content;
    private $id_user;

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
 
    /**
     * Setters
     */
    public function setId_article(?int $id_article)
    {  
        $id = (int) $id_article;
        if ($id > 0){
            $this->id_article = $id_article;
        }
    }

    public function setTitle(?string $title) 
    {
        if(is_string($title)){
            $this->title = $title;
        }
    }
    public function setId_user(?int $id_user){
        $this->id_user = $id_user;
    }

    public function setChapo(?string $chapo) 
    {
        if(is_string($chapo)){
            $this->chapo = $chapo;
        }
    }

    public function setContent(?string $content) 
    {
        if(is_string($content)){
            $this->content = $content;
        }
    }

    /**
     * Getters
     */
    public function getId_article()
    {
        return $this->id_article;
    }
    
    public function getTitle(): ?string
    {
        return $this->title;
    }    

    public function getChapo(): ?string 
    {
    return $this->chapo;
    }

    public function getContent(): ?string
    { 
        return $this->content;
    }
    public function getId_user(){
        return $this->id_user;
    }
}
