<?php
namespace Entity;

class Comment 
{
 //use Timestampable
    private $id_comment;
    private $content;
    private $id_user;
    private $postId;
    private $disabled;

    
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

    //fkcomment_user
    public function setId_user($id_user) 
    {
        $this->userId = $id_user;
    }



    //Getters
    public function getId(): ?int
    { 
        return $this->id; 
    }

    public function getContent(): ?string
    { 
        return $this->content; 
    }

    public function getId_user(): ?User
    { 
        return $this->id_user; 
    }

    public function getPostId(): self
    { 
        return $this->postId; 
    }
    
    public function getDisabled() 
    { 
        return $this->disabled; 
    }

}
