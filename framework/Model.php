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
        if(self::$_bdd == null){
            self::setBdd();
            return self::$_bdd;
        }
        echo('ok fin fonction getBdd');
    }

    //ERREUR Entité
    protected function getAll($table, $obj){
        $this->getBdd();
        $var = [];
        $req  = self::$_bdd->prepare('SELECT * FROM '. $table.' ORDER BY id_article desc');  
        $req->execute();

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)){
            //$var[] = new $obj($data);
            $var[] = new Article($data); //fonctionne !!!
        }
        return $var;
        $req->closeCursor();
    }

      
        protected function getAllComments($table){
        echo('| Model.php getAllComments ici');
        $id_article = $_SESSION['id_article'];

        $this->getBdd();
        $var = [];
        $req  = self::$_bdd->prepare('SELECT `id_comment`, `content`, `createdat`, `id_user` FROM '. $table.' WHERE $id_article'); 
        $req->execute();



        while ($data = $req->fetch(\PDO::FETCH_ASSOC)){
            //$var[] = new $obj($data);
            $var[] = new Comment($data); //pour hydratation.
        //echo($var);

        //return $var;
        $req->closeCursor();
    }    
}
    
    // corriger la date 
    /**
     * Article
     * Cette fonction cré
     */
    protected function createOne($table, $obj){
        echo('model.php createOne');

        $this->getBdd();
        $req = self::$_bdd->prepare("INSERT INTO ".$table." (title, chapo, content) VALUES (?, ?, ?)");
        $req->execute(array($_POST['title'], $_POST['chapo'], $_POST['content']));
        $req->closeCursor();
    }



    /**
     * Comment
     * Fonction qui insert le commentaire.
     */
    protected function createOneComment($table, $comment){
        echo('| Model.php createOneComment');

        $this->getBdd();

        $req = self::$_bdd->prepare("INSERT INTO ".$table." (content, id_article, id_user) VALUES (?, ?, ?)");
        $req->execute(array($comment, $_SESSION['id_article'], $_SESSION['id_user']));
        $req->closeCursor();
        echo('Fin de script');
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



    //DELETE

    protected function deleteOne($table, $id){
        $this->getBdd();  
        $req = self::$_bdd->prepare("DELETE FROM $table WHERE id_article = $id");
        $req->execute(array());

    } 

    protected function deleteOneComment($table){
        $id_comment = $_SESSION['id_comment'];

        $this->getBdd();  
        $req = self::$_bdd->prepare("DELETE FROM $table WHERE id_comment = $id_comment");
        $req->execute(array());

    } 

  
}