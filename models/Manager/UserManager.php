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
  public function getFullName($listIdUsers){ // list d'ids nbr
    $this->getBdd();
    $req  = self::$_bdd->prepare('SELECT prenom, nom FROM user WHERE id_user = ?'); 


    
    //boucle while de la list ids
    //incrementer 
    $id_user = $listIdUsers[0];

    $req->execute(array($id_user));
    $result = $req->fetch(); 

    $prenom =$result['prenom'];
    $nom =$result['nom'];

    $fullName[] = $prenom.' '.$nom;

  }
}
