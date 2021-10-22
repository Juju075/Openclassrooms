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

            
            if ($userObj=$userMAnager->logonManager($user,$usertype) != null){ 
                $_SESSION['user'] = array(
                    'username' => $user['username'],
                    'password' => $user['password'],
                    'usertype' => $user['usertype']
                );
                return $userObj;
            } 
            else{
                return false;
            }
        }
    }

    public static function  retrieveUserObj($usertype){
        echo('Security retrieveUserObj');
        if(isset($_SESSION['user']['username'])){

            $userMAnager=new UserManager();
            $user = array('username'=>$_SESSION['user']['username'],'password'=>$_SESSION['user']['password'],'usertype'=>$_SESSION['user']['usertype']);
                if ($userObj=$userMAnager->logonManager($user,$user['usertype']) != null){ 
                    return $userObj;
                } 
                else{
                    return false;
                }
        }else{
            return false;
        }

    }

}