<?php
/**
 * namespace App\Entity;
 */

class Comment 
{
    private $id_comment;
    private $content;
    private $dateCreation;
    private $userId;
    private $postId;
    private $username;
    private $disabled;

    public function getId(): ?int
    { 
        return $this->id; 
    }

    public function getContent(): ?string
    { 
        return $this->content; 
    }

    public function getDateCreation()
    { 
        return $this->dateCreation; 
    }

    public function getUserId(): ?User
    { 
        return $this->userId; 
    }

    public function getPostId(): self
    { 
        return $this->postId; 
    }
    
    public function getFormattedDateCreation(): self 
    { 
        return $this->getFormattedDateTime($this->dateCreation); 
    }
    
    public function getUsername() { return $this->username; }
    public function getDisabled() { return $this->disabled; }
    
    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
    }

    public function setId($id) 
    {
    	$this->id = $id;
    }

    public function setContent($content) 
    {
    	$this->content = $content;
    }

    public function setDateCreation($dateCreation) 
    {
    	$this->dateCreation = $dateCreation;
    }

    public function setUserId($userId) 
    {
    	$this->userId = $userId;
    }

    public function setPostId($postId) 
    {
    	$this->postId = $postId;
    }
}
