<?php
/**
 * namespace & use(namespace de Entity pour hydrater)
 */
require_once('framework/Model.php');
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
    public function getList(){
    }
    public function get(){
    }
    public function add(array $obj){ 
        $table = 'User';

        $username = $obj['username'];
        $email = $obj['email'];
        $password = $obj['password'];
        $activated = $obj['activated'];
        $validation_key = $obj['validation_key'];
        $usertype = $obj['usertype'];
        $avatar = $obj['avatar'];


        $this->getBdd();
        $req = self::$_bdd->prepare("INSERT INTO ".$table." (username, email, password, activated, validation_key, usertype, avatar) VALUES (:username, :email, :password, :activated, :validation_key, :usertype, :avatar)");
        $req->execute(array(
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'activated' => $activated,
            'validation_key' => $validation_key,
            'usertype' => $usertype,
            'avatar' => $avatar));   
            
				$destinataire = $email;
				$sujet = "Blob MVC - Activation - no reply" ;
				$entete = "From: http://blog_mvc.net" ;
				$message = $username . 'Confirme ton mail
				
				http://blog_mvc.net/activation.php?log=' . urlencode($username) .'&validation_key='.urlencode($validation_key) . '
				
				---------------
				
				Cet email est à conserver, il vous permet de vous connecter
				à votre espace adherent et vous permet de recevoir les newsletters selon vos critères.

				Ceci est un email automatique, Merci de ne pas y répondre.
				Si vous avez reçu cet email par erreur veuillez contacter le support technique 
				au 01 45 89 25 15.';
				
                echo $message;
				mail($destinataire, $sujet, $message, $entete) ;


				header('location: welcome.php?email='.$email);
                exit();
            //   Fin envoie mail   

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
