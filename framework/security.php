<?php
namespace Tools;
use Manager\UserManager;

class Security
{
/***
 * the function should retrive session parameters ($session) and verify their validity using the authenticationRequest
 * if(($user=Security::login(1))!=null)
 */
public static function login($usertype){
    
    if(isset($_POST) && !empty($_POST['username']) && !empty($_POST['password']))
    {
        $userMAnager=new UserManager();
        $user['username']=$_POST['username'];
        $user['password']=$_POST['password'];
        $user['usertype']=$usertype;
        echo('| security.php affectations');
 
            //if ($userObj=$userMAnager->authenticationRequest($user,$usertype) != null){
            // si la reponse n'est pas null il affecte les parametre de session user    
            var_dump($userMAnager->logonManager($user,$usertype));
//verification role
            if ($userObj=$userMAnager->logonManager($user,$usertype) != null){
                echo('security suite ok');
                
                $_SESSION['user'] = array(
                    'username' => $user['username'],
                    'password' => $user['password']
                );
                echo('| security.php login 1-b cas');
                var_dump($userObj);
                return $userObj; // c la reponse de authenticationRequest
                exit;
            }
            else{
                return false;
            }
    }
}

}