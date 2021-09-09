<?php
/**
 * namespace App\Entity;
 */

require_once('models/Manager/UserManager.php'); // à enlever bizarre

class User  
{
    // use Timestampable;

    const USERTYPE = [
        1 => 'Membre',
        2 => 'Admin'
    ];


    private $username;
    private $password;
    private $email;
    private $activated;
    private $validationKey;
    private $userType;
    private $avatar;
    private $prenom;
    private $nom;


    public function __construct(array $obj){
    
        if(!empty($obj)){

            $this->hydrate($obj);
        }
    }
  
    public function hydrate(array $obj)
    {

		foreach ($obj as $key => $value)
		{

            $key = lcfirst(str_replace('_', '', ucwords($key, '_')));
            
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

    //Setter
    public function setUsername(string $username){
        $this->username = $username;
    }
    public function setPassword(string $password){
        $this->password =$password;
    }
    public function setEmail(string $email){
        $this->email = $email;
    }

/*
    private $activated;  par defaut a 0
    private $validationKey; genere une cle de validation
    private $userType; par defaut 1

*/

    public function setActivated()
    {
        
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

}


