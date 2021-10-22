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

        // pour l' id_article x quels sont les id_comments associes


        $result = [];
        //$id_article = $_SESSION['id_article'];
        //liste tous les articles comments.
        $this->getBdd();
        $req0  = self::$_bdd->prepare('SELECT id_comment FROM comment WHERE id_article = ?'); 
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
    protected function getCommentsCount($comments){
        if(isset($comments) && $comments != null){
           return count($comments);
        }else{
            return 0;
        }
    }

    protected function authenticationRequest($obj,$usertype){
        echo('| Model.php authenticationRequest');

        
        $this->getBdd();
        $req = self::$_bdd->prepare('SELECT id_user, password, activated, usertype  FROM user WHERE username = ?');
        $req->execute(array($obj['username']));
        $resultat = $req->fetch();
        
        $Verif_pass = password_verify(htmlspecialchars($obj['password']), $resultat['password']);
        
        if ($Verif_pass == TRUE && $resultat['activated'] == 1 && $resultat['usertype']==$usertype) {
            $id_user = $resultat['id_user'];
            $_SESSION['id_user']=$id_user; 
            $user=$this->getOne('user','User',$id_user); 
            return $user;
            }else{
                return false;
            }     
        }


    protected function postIfExist(){
        echo('| Model.php postIfExist');
        //lister les id articles encours.
            $this->getBdd();
            $req0  = self::$_bdd->prepare('SELECT id_article FROM article WHERE id_article = ?'); 
            $req0->execute(array($_SESSION['id_article']));
            $idArticle = $req0->fetchall();
            if(!empty($idArticle )){
                return true;
            }else{
                return false;
            }
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

        $interrogationString=implode(' , ',$interrogation);
        $this->getBdd();
        $sql="INSERT INTO ".$table." (".$keysString.") VALUES (".$interrogationString.")";

        try {$req = self::$_bdd->prepare($sql);
            $req->execute($values);}
            catch(\PDOException $e)
            {
                $e->errorInfo;
            }
        $req->closeCursor();
    }

    protected function createOneComment($table, $comment){
        $this->getBdd();

        $req = self::$_bdd->prepare("INSERT INTO ".$table." (content, id_article, id_user) VALUES (?, ?, ?)");
        $req->execute(array($comment, $_SESSION['id_article'], $_SESSION['id_user']));
        $req->closeCursor();
    }
    ///////////////////////////////////

    // Notice: Array to string conversion in C:\wamp64\www\App_Blog_MVC\framework\Model.php on line 183
    protected function noDuplicatePost($table, $title, $content){ 
        echo('| model.php noDuplicatePost');
                $titleresult[]= null;
                $this->getBdd();
                $req = self::$_bdd->prepare("SELECT id_article FROM " .$table. " WHERE title = ?");
                $req->execute(array($title));
                $titleresult = $req->fetchall(); // assert list 0 or >=1 id_article


        if (!empty($titleresult)) { 
                $req = self::$_bdd->prepare("SELECT content FROM " .$table. " WHERE id_article = ?");
                $req->execute(array($titleresult[0]));
                $contentresult = $req->fetchall(); 

                    if ($contentresult === $content) {
                        return true;
                    }
                    else{ 
                        return false;
                    }
        }
        else{
            return false;
        }
    }

    protected function getOne($table, $obj, $id){ 
        echo('| Model.php getOne');
        $this->getBdd();
        $var = [];

        if ($obj === 'Article') {
            echo('| requete prepare Article'); // ok fonctionne
            //$req = self::$_bdd->prepare("SELECT id_article, title, content, DATE_FORMAT(updatedAt, '%d/%m/%Y à %Hh%imin%ss') AS date FROM " .$table. " WHERE id_article = ?");   
            $req = self::$_bdd->prepare("SELECT id_article, title, chapo, content, DATE_FORMAT(updatedAt, '%d/%m/%Y à %T') AS date FROM " .$table. " WHERE id_article = ?");   
        }elseif ($obj === 'User'){
            echo('| requete prepare User'); // Obejt $user auth / Info display page profil
            $req = self::$_bdd->prepare("SELECT usertype, prenom, nom, email, activated, validation_key, avatar, sentence   FROM " .$table. " WHERE id_user= ?");   
        }elseif ($obj === 'Comment') {
            echo('| requete prepare Comment'); //
            $req = self::$_bdd->prepare("SELECT id_comment, content, createdat DATE_FORMAT(updatedAt, '%d/%m/%Y à %T') AS date FROM " .$table. " WHERE id_comment = ?");
        }else{
            echo('| erreur');
        }     
        $req->execute(array($id));

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

    //Cannot delete or update a parent row: a foreign key constraint fails
    /////////////
    protected function deleteOne($table, $id){
        $this->getBdd();  
        $req = self::$_bdd->prepare('SELECT * FROM comment WHERE id_article = ?');
        $req->execute(array($id));
        $comments = $req->fetchall();

        if (count($comments) != 0) {
            $req = self::$_bdd->prepare('DELETE  FROM comment WHERE id_article = ?');
            $req->execute(array($id)); 
        }else{
        }   
        $req = self::$_bdd->prepare("DELETE FROM " .$table. " WHERE id_article = ?");
        $req->execute(array($id));
    } 
    

    protected function deleteOneComment($table){
        //verification du role       
        $id_comment = $_SESSION['id_comment'];
        $this->getBdd();  
        $req = self::$_bdd->prepare("DELETE FROM " .$table. " WHERE id_comment = $id_comment");
        $req->execute(array());
        $req->closeCursor();
    } 
    /////////////////

//
    //verifier si le token est l'auteur du comment specifie.
    //Serie d\'interogation
    protected function commentValidation($id_comment, $validation_key){

        $this->getBdd();  
        //Est ce que le token est bien celui de l'utilisateur
        //
        $req = self::$_bdd->prepare("SELECT id_user  FROM user WHERE validation_key = ?");
        $req->execute(array($validation_key)); 
        $user = $req->fetch();
        
        
        //Verifie si c bien lauteur du comment
        if(isset($user) && $user != null){
            echo('user not empty');
            $req = self::$_bdd->prepare("SELECT id_user  FROM comment WHERE id_comment = ?");
            $req->execute(array($id_comment)); 
            $result = $req->fetchall();
            $req->closeCursor(); 

            if ($result[0]['id_user'] == $user[0]){ // pb ici
                echo('user correspondance ok');
                //valider l'affichage
                $req = self::$_bdd->prepare("UPDATE comment SET disabled = 1 WHERE id_comment = ?");
                $req->execute(array($id_comment));
                $req->closeCursor(); 
                echo('activer le commentaire ok');
                return true;  
            }else{
                echo('return false 2');
                return false;
            }
        }else{
            echo('return false 1');
            return false;
        }
    }

    protected function updateOne($table, $data){ // article ou comment 
        $this->getBdd();
        $title = $data['title'];
        $content = $data['content'];
        if ($table === 'article') { 
            if(isset($title) && $title != ''){
                $req = self::$_bdd->prepare("UPDATE " .$table. " SET title = ?  WHERE id_article = ?");
                $req->execute(array($title, $_SESSION['id_article']));
                $req->closeCursor();
            }else{}
            if(isset($content) && $content != ''){
                $req = self::$_bdd->prepare("UPDATE " .$table. " SET content = ?  WHERE id_article = ?");
                $req->execute(array($content, $_SESSION['id_article']));
                $req->closeCursor();
            }else{}
        }
        if ($table === 'comment') {
            # code...
        }
    }
}