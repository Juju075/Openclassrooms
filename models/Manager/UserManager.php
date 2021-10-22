<?php
namespace Manager;
use Tools\Model;

class UserManager extends Model
{
    public function addUser($user){
      return $this->createOne('user', $user);
   }
    
    public function logonManager($user,$usertype){
      return $this->authenticationRequest($user,$usertype);
   }
   public function ProfilUser(){
     return $this->getOne('user','User', $_SESSION['id_user']);
   }
}
