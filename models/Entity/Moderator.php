<?php
namespace Entity;

class Moderator
{
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

    public function setId_moderator(?int $id_moderator)
    {  
        $id = (int) $id_moderator;
        if ($id > 0){
            $this->id_moderator = $id_moderator;
        }
    }

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
    public function getId_moderator()
    {
        return $this->id_moderator;
    }
    public function getlink(){
        return $this->link;
    }
    public function getCreatedat(){
        return $this->createdat;
    }
    public function getErase(){
        return $this->erase;
    }



    /**
     * Foreigh key
     */
    public function setId_comment($id_comment){
        $this->id_comment = $id_comment;
    }

    public function getId_comment(){
        return $this->id_comment;
    }
}
