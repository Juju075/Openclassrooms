<?php
namespace Entity;

class Moderator
{
 //use Timestampable
    private $id_moderator;
    private $createdat;
    private $link;
    private $erase;
    private $id_comment;




    
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
    public function setLink($link){
        $this->link = $link;
    }
    public function setErase($erase){
        $this->erase = $erase;
    }
     public function setCreatedat($createdat){
        $this->createdat = $createdat;
    }   

/**
 * Getters
 */
    public function getlink(){
        return $this->link;
    }
    public function getErase(){
        return $this->erase;
    }
    public function getCreatedat(){
        return $this->createdat;
    }

/**
 * Foreigh key
 */
    public function setIdComment($id_comment){
        $this->id_comment = $id_comment;
    }

    public function getIdid_comment(){
        return $this->id_comment;
    }



}