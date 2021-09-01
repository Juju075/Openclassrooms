<?php
require_once 'views/View.php';
require_once('models/Manager/UserManager.php'); // à enlever bizarre
require_once('models/Entity/User.php'); // à enlever bizarre
/**
 * 
 */
class ControllerRegister
 {
     private $user;

    //Hydratation de obj 
    public function __construct(){
        if(isset($url) && count($url) < 1){
            throw new \Exception("Page introuvable", 1);
        }
        elseif (isset($_GET['create'])){
            $this->create();       
            echo('controller option 1');
        }
        elseif (isset($_GET['status']) && isset($_GET['status']) =="new"){
            $this->store();       
            echo('controller option 2');
        }
        else{
            echo('controller option 3');
        }
    }


    private function create(){
        
        if(isset($_GET['create'])){

            $this->_view = new View('CreateUser', 'Registration');
            $this->_view->displayForm('Register');
        }
    }

    private function store(){
        if(!empty($_POST['email'] && $_POST['checkpassword'])){
            $email = $_POST['email'];

            if (filter_var($email, FILTER_VALIDATE_EMAIL)){

                if ($_POST["password"] == $_POST["checkpassword"]){
                    $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $username = ucfirst($_POST['username']);
                    $token = '123456'; //random_bytes (10); // a corriger

                    $default_avatar = '01.jpg';
                    $obj = array('username'=> $_POST['username'],'password'=> $pass_hache,'email'=> $_POST['email'],'activated'=>'1','validation_key'=> $token,'usertype'=>'1','avatar' => $default_avatar);


                    $this->_user = new User($obj); 
                 

                    $transfert = new UserManager;       	
                    $transfert->add($obj);

                    header('location: accueil');

 

 
                }
            }
        }

    }

 }