<?php
namespace Manager;
use Tools\Model;

class UserManager extends Model
{
    public function addUser($user){
        echo('| UserManager.php logon');
      return $this->createOne('user', $user);
   }
    
    /**
     * should just send request and return result of verification
     */
    public function logonManager($user,$usertype){
        echo('| UserManager.php logonManager');
      return $this->authenticationRequest($user,$usertype);
   }
   public function ProfilUser(){
     return $this->getOne('user','User', $_SESSION['id_user']);
   }
}
