<?php
namespace Manager;
use Tools\Model;

class UserManager extends Model
{
    // Mettre dans Model.php Rajouter des champs
    //utiliser createOne
    public function add(array $obj){ 
        $table = 'User';
        //ceatedate
        //updatedate
        $username = $obj['username'];
        $password = $obj['password'];
        $email = $obj['email'];
        $activated = $obj['activated'];
        $validation_key = $obj['validation_key'];
        $usertype = $obj['usertype'];
        $sentence = $obj['sentence'];
        $prenom = $obj['prenom'];
        $nom = $obj['nom'];

        $avatar = $obj['avatar'];

        $this->getBdd();
        //manque les attribut date
        $req = self::$_bdd->prepare("INSERT INTO ".$table." (username, email, password, activated, validation_key, usertype, prenom, nom, avatar, sentence) VALUES (:username, :email, :password, :activated, :validation_key, :usertype, :prenom, :nom, :avatar, :sentence)");
        $req->execute(array(
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'activated' => $activated,
            'validation_key' => $validation_key,
            'usertype' => $usertype,
            'prenom' => $prenom,
            'nom' => $nom,
            'sentence' => $sentence,
            'avatar' => $avatar));   

        $req->closeCursor();
        return $this;
    }

    public function add2($obj){
        echo('| UserManager.php logon');
      return $this->createOne('user', $obj);
   }


    public function delete(){
    }
    public function update(){
    }
    
    /**
     * should just send request and return result of verification
     */
    public function logonManager($user,$usertype){
        echo('| UserManager.php logonManager');
      return $this->authenticationRequest($user,$usertype);
   }

}
