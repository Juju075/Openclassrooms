<?php
namespace controllers;
session_start();

use Entity\User;
use Manager\UserManager;
use View\View;
use Tools\Security;

class ControllerRegister
{
     private $userManager;
     private $view;

    public function __construct(){
        if(isset($url) && count($url) < 1){
            throw new \Exception("Page introuvable", 1);
        }
        elseif (isset($_GET['create'])){
            $this->create();       
        }
        elseif (isset($_GET['status']) && isset($_GET['status']) =="new"){ 
            $this->store();       
        }
        else{
        }
    }

    private function create(){
        if(isset($_GET['create'])){
        if(($user=Security::login('MEMBRE'))!==null){ 
        } 
            $data = null;
            $this->view = new View('CreateUser', 'Registration');
            $this->view->displayForm('Register',$data);
        }
    }

    private function store(){
        if (isset($_POST) && empty($_SESSION['user'])){
                if(!empty($_FILES) && $_FILES['foo']['size'] != 0){
                    $this->imageUpload();
                    $avatar = $_SESSION['avatar'];
                }
                else{
                    echo('/ image non telechargé');
                    $avatar = 'default_avatar.jpg'; 
                }
                if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $token = md5($_POST['prenom'].$_POST['nom']); 
                    $obj = array('username'=> $_POST['username'],'password'=> $pass_hache,'email'=> $_POST['email'],'activated'=>'1','validation_key'=> $token,'usertype'=>'MEMBRE','prenom'=> $_POST['prenom'],'nom'=> $_POST['nom'],'avatar' => $avatar,'sentence'=>$_POST['sentence']);
                    $user= new User($obj);
                    $userManager = new UserManager();
                    $userManager->addUser($user);
                    unset($_SESSION['avatar']);
                    header('location: accueil&register=created');
                }
                else{
                header('location: accueil&register=error');
            }    
        }else{
            header('location: accueil&register=error');
        }
    }

    private function imageUpload(){
        echo('| ControllerRegister imageUpload');          
        $storage = new \Upload\Storage\FileSystem( __DIR__."/../public/images/uploads/");
        $file = new \Upload\File('foo', $storage);

        $new_filename = uniqid();
        $file->setName($new_filename);
        $_SESSION['avatar'] = $new_filename;


        // Validate file upload
        // MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
        $file->addValidations(array(
        // Ensure file is of type "image/png"
        new \Upload\Validation\Mimetype('image/jpeg', 'image/png'),

        //You can also add multi mimetype validation
        //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

        // Ensure file is no larger than 5M (use "B", "K", M", or "G")
        new \Upload\Validation\Size('5M')
        ));

        // Access data about the file that has been uploaded
        $data = array(
        'name' => $file->getNameWithExtension(),
        'extension' => $file->getExtension(),
        'mime' => $file->getMimetype(),
        'size' => $file->getSize(),
        'md5' => $file->getMd5(),
        'dimensions' => $file->getDimensions()
        );

        $imageName = $data['name']; //ajouter extention.
        // Try to upload file
        try {
        // Success!
        $file->upload();

        } catch (\Exception $e) {
        // Fail!
        $errors = $file->getErrors();
        }

            // FIN CODE CODEGUY UPLOAD
        }
}
