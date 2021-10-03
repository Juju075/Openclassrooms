<?php
namespace Entity;

class User  
{
    // use Timestampable;

    const USERTYPE = [
        1 => 'Membre',
        2 => 'Admin'
    ];

    // created_date et modified_date dans timestampable  $createdAt $updatedAt
    private $id_user;
    private $username;
    private $password;
    private $email;

    private $activated; //defaut 0
    private $validationKey; //genere
    //private $_userType; // defaut 1
    

    private $avatar;
    private $prenom; // champs 
    private $nom; // champs
    private $sentence;


    public function __construct(array $obj){
        if(!empty($obj)){
            $this->hydrate($obj);
            var_dump($obj);
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


    private function addUser($table, $obj){
        $this->_user;
    }



    //Setters
        public function setId_article(?int $id_user)
    {  
        $id = (int) $id_user;
        if ($id > 0){
            $this->id_user = $id_user;
        }
    }

    public function setId_user(int $id_user){
        $this->id_user = $id_user;
    }
    public function setPrenom(string $prenom){
        $this->prenom = $prenom;
    
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
    
    /*
    private $activated;  par defaut a 0
    private $validationKey; genere une cle de validation
    private $userType; par defaut 1
    
    */
    
    public function setActivated(int = 0)
    {
        $this->Activated = $Activated;
    }
    public function setValidationKey()
    {
        //generer un code hass simple
    }
    
    public function setAvatar(string $avatar)
    {
        $this->avatar = $avatar;
    }    

    



    //Getters

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
        return $this->_password;
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


