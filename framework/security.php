<?php
namespace Tools;
use Manager\UserManager;

class Security
{

public static function login($usertype){
    
    if(isset($_POST) && !empty($_POST['username']) && !empty($_POST['password']))
    {
        $userMAnager=new UserManager();
        $user['username']=$_POST['username'];
        $user['password']=$_POST['password'];
        $user['usertype']=$usertype;
        echo('| security.php login ok form data');
 
        //if ($userObj=$userMAnager->authenticationRequest($user,$usertype) != null){
        if ($userObj=$userMAnager->logonManager($user,$usertype) != null){
            echo('security suite ok');
            $_SESSION['user'] = array(
                'username' => $user['username'],
                'password' => $user['password']
            );
            echo('| security.php login 1-b cas');
            return $userObj;
            var_dump($userObj);
        }
        else{
            return false;
        }
    }
}

}