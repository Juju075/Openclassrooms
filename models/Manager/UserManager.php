<?php
namespace Manager;
use Tools\Model;

/**
 * Toute les fonctionnalités.
 * getList()
 * get()
 * add()
 * delete()
 * update()
 * login()
 */

class UserManager extends Model
{
    // Mettre dans Model.php Rajouter des champs
    public function add(array $obj){ 
        echo($obj);

        $table = 'User';

        //ceatedate
        //updatedate

        $username = $obj['username'];
        $password = $obj['password'];
        $email = $obj['email'];
        $activated = $obj['activated'];
        $validation_key = $obj['validation_key'];
        $usertype = $obj['usertype'];

        $prenom = $obj['prenom'];
        $nom = $obj['nom'];

        $avatar = $obj['avatar'];

        $this->getBdd();
        //manque les attribut date
        $req = self::$_bdd->prepare("INSERT INTO ".$table." (username, email, password, activated, validation_key, usertype, prenom, nom, avatar) VALUES (:username, :email, :password, :activated, :validation_key, :usertype, :prenom, :nom, :avatar)");
        $req->execute(array(
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'activated' => $activated,
            'validation_key' => $validation_key,
            'usertype' => $usertype,
            'prenom' => $prenom,
            'nom' => $nom,
            'avatar' => $avatar));   

        $req->closeCursor();
        return $this;
    }

    public function delete(){
    }
    public function update(){
    }
    
    public function login($obj){

        $this->getBdd();
        $req = self::$_bdd->prepare('SELECT password, activated  FROM user WHERE username = ?');
        $req->execute(array($obj['username']));
        $resultat = $req->fetch();


        $Verif_pass = password_verify(htmlspecialchars($obj['password']), $resultat['password']);

        if ($Verif_pass == TRUE && $resultat['activated'] == 1) {

            header('location: accueil?passe=valide');
            
        }else{
            $smg = 'Mauvais mot de pass ou login ou cpt non valide.';
            header('location: accueil?passe=non_valide');
        }     
        return $this;   
    }
    public function contact(){
    }

}
