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
        echo('| Model.php getBdd ');
        if(self::$_bdd == null){
            self::setBdd();
        }
        return self::$_bdd;
    }

    //ERREUR Entité
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
      
    protected function getAllComments($table){
        echo('| Model.php getAllComments');
        $id_article = $_SESSION['id_article'];

        $this->getBdd();
        $var = [];
        //ORDER BY
        //$req  = self::$_bdd->prepare('SELECT id_comment, content, createdat, id_user FROM '. $table.' WHERE $id_article'); 
        $req  = self::$_bdd->prepare('SELECT id_comment, content, id_user FROM comment'); 
        $req->execute();

        //while ($data = $req->fetch(\PDO::FETCH_ASSOC)){
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)){
            //$var[] = new $obj($data);
        
            //Collection d'objets comments id_comment
            $var[] = new Comment($data); //pour hydratation assignation des valeurs par cles.
            var_dump($var);// assert collection de posts.
            
            return $var; 
            echo('| jusqu ici tous vas bien 3');
            $req->closeCursor();
    }    
}

    protected function testGetAllComments($table){
        echo('| Model.php testGetAllComments');

        $result = [];
        $id_article = $_SESSION['id_article'];

        //liste id_article existant 
        $this->getBdd();
        $req0  = self::$_bdd->prepare('SELECT id_article FROM comment'); 
        $req0->execute();
        $result = $req0->fetchall();
        
        $nb = count($result);
        //var_dump($result);
        //exit();

        //si id article = result alors on execute 
        for ($i=0; $i<=$nb; $i++) { 

            if ($_SESSION['id_article'] === $id_article ) {         
                $this->getBdd();
                $var= [];
                
                $req  = self::$_bdd->prepare('SELECT id_comment, content, createdat, id_user FROM comment WHERE id_article = ?'); 
                $req->execute(array($id_article));
                $var = $req->fetchall();
                return $var; 
                break;
            }else{}
            
        }
    }

protected function testGetAllCommentsRefactoring($table){
    echo('| Model.php testGetAllCommentsRefactoring');

        $id_article = $_SESSION['id_article'];

        //Est ce que lid_article possede au moins un commentaire.
        $this->getBdd();
        $req0  = self::$_bdd->prepare('SELECT id_article FROM comment WHERE id_article = ?'); 
        $req0->execute(array($id_article));
        $result = $req0->fetchall();

        // if (){
        //         $this->getBdd();
        //         $var= [];
                
        //         $req  = self::$_bdd->prepare('SELECT id_comment, content, createdat, id_user FROM comment WHERE id_article = ?'); 
        //         $req->execute(array($id_article));
        //         $var = $req->fetchall();
        //         return $var; 
        // }else{}

}

    



protected function authenticationRequest($obj,$usertype){
    echo('| Model.php authenticationRequest');
        $this->getBdd();
        $req = self::$_bdd->prepare('SELECT id_user, password, activated, usertype  FROM user WHERE username = ?');
        $req->execute(array($obj['username']));
        $resultat = $req->fetch();
        $Verif_pass = password_verify(htmlspecialchars($obj['password']), $resultat['password']);

        if ($Verif_pass == TRUE && $resultat['activated'] == 1 && $resultat['usertype']==$usertype) {
            echo('Condition verifie a true');


            $id_user=$resultat['id_user'];
            $user=$this->getOne('user','User',$id_user);
            
            return $user;  
        }else{
            echo('condition else false');
            return false;
        }     
    }

protected function postIfExist(){
    echo('| Model.php postIfExist');

    //lister les id articles encours.
        $id_article = $_SESSION['id_article'];
        $this->getBdd();
        $req0  = self::$_bdd->prepare('SELECT id_article FROM article WHERE id_article = ?'); 
        $req0->execute(array($id_article));
        return $req0->fetchall();
}


protected function noDuplicatePost($table, $title, $content){
    echo('| model.php createOne');
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
                else{
                    return false;
                }
    }
    else{
        return false;
    }

}


    // corriger la date 
    /**
     * Article 
    * Methods inside Model.php shouldn't be specific to any entity issue 38
     */
    protected function createOne($table, $obj){
    echo('| model.php createOne');
        $array=(array)$obj;
        $classFullName=get_class($obj);
        var_dump($classFullName);

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
        echo $sql;
        var_dump($sql);
        try {$req = self::$_bdd->prepare($sql);
            $req->execute($values);}
            catch(\PDOException $e)
            {
                $e->errorInfo;
            }
        
        $req->closeCursor();
    }



    /**
     * Comment
     * Fonction qui insert le commentaire.
     */
    protected function createOneComment($table, $comment){
        echo(' >> Model.php createOneComment');
        $this->getBdd();

        $req = self::$_bdd->prepare("INSERT INTO ".$table." (content, id_article, id_user) VALUES (?, ?, ?)");
        $req->execute(array($comment, $_SESSION['id_article'], $_SESSION['id_user']));
        $req->closeCursor();
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

    

    //ERREUR Entité
    protected function getOne($table, $obj, $id){ //Article
        $this->getBdd();
        $var = [];

        $req = self::$_bdd->prepare("SELECT id_article, title, content, DATE_FORMAT(updatedAt, '%d/%m/%Y à %Hh%imin%ss') AS date FROM " .$table. " WHERE id_article = ?");
        $req->execute(array($id));

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)){
            //$var[] = new $obj($data);  // eg: Article || ERREUR
            $var[] = new Article($data);
        }
        return $var;
        $req->closeCursor();  
    }

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