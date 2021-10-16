<?php
namespace controllers;
session_start();

use Entity\User;
use Manager\UserManager;
use View\View;

class ControllerRegister
 {
     private $user;
     private $view;

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

            $data = '';
            $this->view = new View('CreateUser', 'Registration');
            $this->view->displayForm('Register',$data);
        }
    }

    private function store(){
        echo('ControllerRegister store');

        //if (isset($_POST) && empty($_SESSION['user'])){
        if (isset($_POST)){

            if(!empty($_FILES)){  //Traitement de l'image en premier (pour recuperer nom de l'image).
                echo('/ oui image telechargé');

                $this->imageUpload();
                //nom du fichier  protected 'originalName' => string '17794632_500_D.jpg' (length=18)
                // le fichier est un objet $file 
                echo('/ Fin upload image');
                $avatar = 'image_telecharge.jpg'; 
            }else{
                echo('/ image non telechargé');
                $avatar = 'default_avatar.jpg'; 
            }
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            echo(' / Verif mail et new User');
            $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $token = md5($_POST['prenom'].$_POST['nom']); 
            $obj = array('username'=> $_POST['username'],'password'=> $pass_hache,'email'=> $_POST['email'],'activated'=>'0','validation_key'=> $token,'usertype'=>'1','prenom'=> $_POST['prenom'],'nom'=> $_POST['nom'],'avatar' => $avatar,'sentence'=>$_POST['sentence']);
            $user= new User($obj);
            $userManager= new UserManager();
            $userManager->addUser($user);
            header('location: accueil&register=created');
        }else{
        header('location: accueil&register=error');
         }           
        }else{
        }
    }

    private function imageUpload(){
        echo('| ControllerRegister imageUpload');          
        $storage = new \Upload\Storage\FileSystem('public\images\upload'); 
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
        'name' => $file->getNameWithExtension(),
        'extension' => $file->getExtension(),
        'mime' => $file->getMimetype(),
        'size' => $file->getSize(),
        'md5' => $file->getMd5(),
        'dimensions' => $file->getDimensions()
        );

        $imageName = $data['name'];
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