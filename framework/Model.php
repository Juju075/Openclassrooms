<?php
namespace Tools;
use Entity\Article;
use Entity\Comment;

/**
 * require_once('models/Entity/Article.php');
 */

abstract class Model
{
    protected static $_bdd;
    

    private static function setBdd(){   
        try {
            $filePath = 'config.json';
            //$filePath = __DIR__.'/config.json';

            $configfile = fopen($filePath, 'r');
            $config= json_decode(fread($configfile, filesize($filePath)));

            self::$_bdd = new \PDO('mysql:host='.$config->host.';dbname='.$config->dbname.';charset=utf8', $config->user, $config->pass);
            self::$_bdd->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);

        } catch
            (\PDOException $e) {
            echo "<p>Erreur: " . $e->getMessage();
            die();
        }
    }

    protected function getBdd(){
        echo('| Connexion Bdd ');
        if(self::$_bdd == null){
            self::setBdd();
        }
        return self::$_bdd;
    }

    protected function getAll($table, $obj){
        $this->getBdd();
        $var = [];
        $req  = self::$_bdd->prepare('SELECT * FROM '. $table.' ORDER BY id_article desc');  
        $req->execute();

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)){
            $obj2="\\Entity\\".$obj;
            $var[] = new $obj2($data);
        }
        return $var;
        $req->closeCursor();
    }
    

    protected function getAllComments(){
        echo('| Model.php getAllComments');

        $result = [];
        //$id_article = $_SESSION['id_article'];

        //liste tous les articles comments.
        $this->getBdd();
        $req0  = self::$_bdd->prepare('SELECT id_article FROM comment WHERE id_article = ?'); 
        $req0->execute(array($_SESSION['id_article']));
        $result = $req0->fetchall();
          
        if(!empty($result)){
                $var= [];
                $req  = self::$_bdd->prepare('SELECT id_comment, content, createdat, id_user FROM comment WHERE id_article = ? AND disabled = 1'); 
                $req->execute(array($_SESSION['id_article']));
                $var = $req->fetchall();
                return $var; 
        }else{}
        
    }

    protected function authenticationRequest($obj,$usertype){
        echo('| Model.php authenticationRequest');
            $this->getBdd();
            $req = self::$_bdd->prepare('SELECT id_user, password, activated, usertype  FROM user WHERE username = ?');
            $req->execute(array($obj['username']));
            $resultat = $req->fetch();
            $Verif_pass = password_verify(htmlspecialchars($obj['password']), $resultat['password']);

            if ($Verif_pass == TRUE && $resultat['activated'] == 1 && $resultat['usertype']==$usertype) {
                echo('| Model.php condition verifie à true'); // ok fonctionne
                //affecter la session user
                $id_user = $resultat['id_user'];
                var_dump($id_user);
                $_SESSION['id_user']=$id_user; //ajout junior
                

                $user=$this->getOne('user','User',$id_user); 
                echo('/ Fin true authenticationRequest');
                return $user;  
            }else{
                echo('| Model.php condition else false'); // ok fonctionne
                return false;
            }     
        }

    protected function postIfExist(){
        echo('| Model.php postIfExist');

        //lister les id articles encours.
            $this->getBdd();
            $req0  = self::$_bdd->prepare('SELECT id_article FROM article WHERE id_article = ?'); 
            $req0->execute(array($_SESSION['id_article']));
            return $req0->fetchall();
    }


    ///////////////////////////////////
        protected function createOne($table, $obj){
        echo('| model.php createOne');
            $array=(array)$obj;
            $classFullName=get_class($obj);

            $keys=[];
            $values=[];
            $data=[];
            $interrogation=[];

            foreach ($array as $key=>$value){
                
                array_push($keys, strtolower(substr(str_replace($classFullName,"",$key),2)));
                array_push($values, $value);
                array_push($interrogation,'?');
                $data[strtolower($key)]=$value;
            }
    
            $keysString=implode(' , ',$keys);
            var_dump($keysString);

            $interrogationString=implode(' , ',$interrogation);
            $this->getBdd();
            $sql="INSERT INTO ".$table." (".$keysString.") VALUES (".$interrogationString.")";
            var_dump($sql);
            
            try {$req = self::$_bdd->prepare($sql);
                $req->execute($values);}
                catch(\PDOException $e)
                {
                    $e->errorInfo;
                }
            
            $req->closeCursor();
        }

        protected function createOneComment($table, $comment){
            echo(' >> Model.php createOneComment');
            $this->getBdd();

            $req = self::$_bdd->prepare("INSERT INTO ".$table." (content, id_article, id_user) VALUES (?, ?, ?)");
            $req->execute(array($comment, $_SESSION['id_article'], $_SESSION['id_user']));
            $req->closeCursor();
        }
    ///////////////////////////////////

    // creation d'un article ou reload article new url.
    protected function noDuplicatePost($table, $title, $content){ // ok fonctionne
        echo('| model.php noDuplicatePost');
                $titleresult[]='';
                $this->getBdd();
                $req = self::$_bdd->prepare("SELECT id_article FROM " .$table. " WHERE title = ?");
                $req->execute(array($title));
                $titleresult = $req->fetchall(); // assert list 0 or >=1 id_article
                var_dump($titleresult);

        if (!empty($titleresult)) { //Ce titre existe. > recuperer l'id de l'article 
                $req = self::$_bdd->prepare("SELECT content FROM " .$table. " WHERE id_article = ?");
                var_dump($titleresult[0]);

                $req->execute(array($titleresult[0]));
                $contentresult = $req->fetchall(); // error  Array to string conversion
                var_dump($contentresult);
                    if ($contentresult === $content) {
                        echo('contenu identique');
                        return true;
                    }
                    else{ //Ce titre n'existe pas. > creer l'article
                        return false;
                    }
        }
        else{
            return false;
        }

    }


        // protected function updateOne($table, $id){
        //     //$_POST['title'], $_POST['chapo'], $_POST['content']
        //     $this->getBdd();  
        //     $req = self::$_bdd->prepare("UPDATE $table SET title = '$_POST['title']', chapo = '$_POST['chapo']', content = '$_POST['content']' WHERE id_article = $id");


        //     //$req->execute(array($_POST['title'], $_POST['chapo'], $_POST['content']));

        // } 

        // protected function updateOneComment($table, $id){
        //     try{
        //         $this->getBdd(); 
        //         $req = self::$_bdd->prepare("UPDATE ".$table." SET content = $_POST['content']');
        //         $req->execute(array();
        //     }
        //     catch(\PDOException $e){
        //         echo($e->getMessage);
        //     }
        // }

    protected function getOne($table, $obj, $id){ 
        echo('| Model.php getOne');
        $this->getBdd();
        $var = [];

        if ($obj === 'Article') {
            echo('| requete prepare Article'); // ok fonctionne
            $req = self::$_bdd->prepare("SELECT id_article, title, content, DATE_FORMAT(updatedAt, '%d/%m/%Y à %Hh%imin%ss') AS date FROM " .$table. " WHERE id_article = ?");   
        }elseif ($obj === 'User'){
            echo('| requete prepare User'); // Info display page profil
            $req = self::$_bdd->prepare("SELECT prenom, nom, email FROM " .$table. " WHERE id_user= ?");   
        }elseif ($obj === 'Comment') {
            echo('| requete prepare Comment'); //
            $req = self::$_bdd->prepare("SELECT id_comment, content, createdat DATE_FORMAT(updatedAt, '%d/%m/%Y à %Hh%imin%ss') AS date FROM " .$table. " WHERE id_comment = ?");
        }else{
            echo('| erreur');
        }     
        $req->execute(array($id));
        echo('| requete success');

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)){
            $obj2="\\Entity\\".$obj;
            $var[] = new $obj2($data); 
        }
        return $var; 
        $req->closeCursor();  
    }
    protected function getAllUsersForComments(){ //$user
        //list d id_user
        //boucle for nb utilisateur 
        //recup prenom nom 

    }

    //Universalisé cette function
    /////////////
    protected function deleteOne($table, $id){
        $this->getBdd();  
        $req = self::$_bdd->prepare("DELETE FROM $table WHERE id_article = $id");
        $req->execute(array());

    } 

    protected function deleteOneComment($table){
        //verification du role
        
        $id_comment = $_SESSION['id_comment'];
        $this->getBdd();  
        $req = self::$_bdd->prepare("DELETE FROM $table WHERE id_comment = $id_comment");
        $req->execute(array());
    } 
    /////////////////


    protected function commentValidation($id_comment, $token){
        //verification de role
        //verification de id_comment & token associé.
        //si id_comment dans comment non valider 0>1 ()
        //
            $this->getBdd();  
        $req = self::$_bdd->prepare("UPDATE  FROM comment SET comment value = 1 WHERE id_comment = $id_comment");
        $req->execute(array());       
    }
  
}