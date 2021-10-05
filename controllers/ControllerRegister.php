<?php
namespace controllers;

use Entity\User;
use Manager\UserManager;
use View\View;

class ControllerRegister
 {
     private $user;

    public function __construct(){
        if(isset($url) && count($url) < 1){
            throw new \Exception("Page introuvable", 1);
        }
        elseif (isset($_GET['create'])){
            $this->create();       
        }
        elseif (isset($_GET['status']) && isset($_GET['status']) =="new"){ //Traitement du form
            $this->store();       
        }
        else{
        }
    }


    private function create(){
        echo('ControllerRegister create');
        if(isset($_GET['create'])){

            $this->_view = new View('CreateUser', 'Registration');
            $this->_view->displayForm('Register');
        }
    }


    private function storeTest(){
        echo('ControllerRegister store2');


        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $token = '123456'; //random_bytes (10); // a corriger
        $default_avatar = 'default_avatar.jpg';

        $obj = array('username'=> $_POST['username'],'password'=> $pass_hache,'email'=> $_POST['email'],'activated'=>'1','validation_key'=> $token,'usertype'=>'1','prenom'=> $_POST['prenom'],'nom'=> $_POST['nom'],'avatar' => $default_avatar);
        

// CODE CODEGUY UPLOAD
// can validate and upload the file like this

$storage = new \Upload\Storage\FileSystem('/public/images/upload');  //dans vendor
$file = new \Upload\File('foo', $storage);

// Optionally you can rename the file on upload
$new_filename = uniqid();
$file->setName($new_filename);

// Validate file upload
// MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
$file->addValidations(array(
    // Ensure file is of type "image/png"
    new \Upload\Validation\Mimetype('image/png'),

    //You can also add multi mimetype validation
    //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

    // Ensure file is no larger than 5M (use "B", "K", M", or "G")
    new \Upload\Validation\Size('5M')
));

// Access data about the file that has been uploaded
$data = array(
    'name'       => $file->getNameWithExtension(),
    'extension'  => $file->getExtension(),
    'mime'       => $file->getMimetype(),
    'size'       => $file->getSize(),
    'md5'        => $file->getMd5(),
    'dimensions' => $file->getDimensions()
);

// Try to upload file
try {
    // Success!
    $file->upload();
} catch (\Exception $e) {
    // Fail!
    $errors = $file->getErrors();
}

// FIN CODE CODEGUY UPLOAD


        var_dump($obj);
        $transfert = new UserManager;       	
        $transfert->addUser($obj);


        //si creer          header('location: accueil?register=created');
        //si erreur divers  header('location: accueil?register=error');

    }

    private function store(){
        echo('ControllerRegister store');

        if (isset($_POST)){
            ;
                $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $token = md5($_POST['prenom'].$_POST['nom']); 
                $default_avatar = 'default_avatar.jpg';

                $array = array('username'=> $_POST['username'],'password'=> $pass_hache,'email'=> $_POST['email'],'activated'=>'1','validation_key'=> $token,'usertype'=>'1','prenom'=> $_POST['prenom'],'nom'=> $_POST['nom'],'avatar' => $default_avatar,'sentence'=>$_POST['sentence']);
                $user= new User($array);
                $userManager= new UserManager();
                var_dump($user);
                $userManager->addUser($user);
                header('location: accueil?register=created');
            }else{
            header('location: accueil?register=error');
        }           
    }
 }