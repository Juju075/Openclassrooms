<?php
namespace Entity;

class User  
{
    /**
     * use Timestampable;
     * created_date et modified_date dans timestampable  $createdAt $updatedAt
     */
    private $usertype; 
    private $id_user;             
    private $username;
    private $password;
    private $email;

    private $activated; 
    private $validation_key;

    private $avatar;
    private $prenom;
    private $nom;
    private $sentence;        

    public function __construct(array $obj){
        if(!empty($obj)){
            $this->hydrate($obj);
        }
    }
  
    public function hydrate(array $obj)
    {
		foreach ($obj as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method))
			{
				$this->$method($value);
            }
        }
    }


    /**
     * Setters
     */
    public function setId_user(?int $id_user)
    {  
        $id = (int) $id_user;
        if ($id > 0){
            $this->id_user = $id_user;
        }
    }
    public function setUsertype($usertype){
        $this->usertype = $usertype;
    }

    public function setPrenom(string $prenom){
        $this->prenom = $prenom;
    }
    
    public function setNom(string $nom){
        $this->nom = $nom;
    }

    public function setUsername(string $username){
        $this->username = $username;
    }

    public function setPassword(string $password){
        $this->password =$password;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

        public function setSentence(string $sentence){
        $this->sentence = $sentence;
    }

    public function setActivated(int $Activated)
    {
        $this->activated = $Activated;
    }

    public function setValidation_key($validation_key)
    {
        $this->validation_key = $validation_key;
    }
    
    public function setAvatar(string $avatar)
    {
        $this->avatar = $avatar;
    }    

    


    /**
     * Getters
     */
    public function getUsertype(){
        return $this->usertype;
    }

    public function getId_user(){
        return $this->id_user;
    }
        public function getPrenom(){
        return $this->prenom;
    }

        public function getNom(){
        return $this->nom;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getAvatar(){
        return $this->avatar;
    }  

    public function getSentence(){
        return $this->sentence;
    } 

    public function getActivated(){
        return $this->activated;
    }

    public function getValidation_key(){
        return $this->validation_key;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
    
        public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getFullName(){
        return $this->getPrenom() . " " . $this->getNom();
    }
}
