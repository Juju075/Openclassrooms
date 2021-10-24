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

    /**
     * Ok univesal function
     */
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

    protected function authenticationRequest($obj,$usertype){ 
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
    ///////////////////////////////////
    protected function createOne($table, $obj){
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

    protected function noDuplicatePost($table, $title, $content){ 
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
        $this->getBdd();
        $var = [];

        if ($obj === 'Article') {
            $req = self::$_bdd->prepare("SELECT id_article, title, chapo, content, DATE_FORMAT(updatedAt, '%d/%m/%Y à %T') AS date FROM " .$table. " WHERE id_article = ?");   
        }elseif ($obj === 'User'){
            $req = self::$_bdd->prepare("SELECT usertype, prenom, nom, email, activated, validation_key, avatar, sentence   FROM " .$table. " WHERE id_user= ?");   
        }elseif ($obj === 'Comment') {
            $req = self::$_bdd->prepare("SELECT id_comment, content, createdat DATE_FORMAT(updatedAt, '%d/%m/%Y à %T') AS date FROM " .$table. " WHERE id_comment = ?");
        }else{
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

        if (count($comments) != 0) { //Attention c tous les comments de l'article
            $req = self::$_bdd->prepare('DELETE  FROM comment WHERE id_article = ?');
            $req->execute(array($id)); 
        }else{
        }   
        $req = self::$_bdd->prepare("DELETE FROM " .$table. " WHERE id_article = ?");
        $req->execute(array($id));
    } 
    


    /////////////////
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