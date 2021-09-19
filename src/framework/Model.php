<?php
namespace Tools;

/**
 * require_once('framework/models/Entity/Article.php'); // à enlever bizarre
 */
//

abstract class Model
{
    protected static $_bdd;
    



    private static function setBdd(){
        self::$_bdd = new PDO('mysql:host=localhost;dbname=app_blog_mvc;charset=utf8','root','');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getBdd(){
        if(self::$_bdd == null){
            self::setBdd();
            return self::$_bdd;
        }
        echo('ok fin fonction getBdd');
    }




    //Cette function est appele par une fonction de xxxxManager.php qui lui passe 2 arguments.
    protected function getAll($table, $obj){
        $this->getBdd();
        $var = [];
        $req  = self::$_bdd->prepare('SELECT * FROM '. $table.' ORDER BY id_article desc');  
        $req->execute();

        while ($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new $obj($data); //le tableau vas instancie un nouvel Article.php en lui passant
        }

        return $var;
        $req->closeCursor();
    }

    //$obj c une entité
    protected function getOne($table, $obj, $id){
        $this->getBdd();
        $var = [];

        $req = self::$_bdd->prepare("SELECT id_article, title, content, DATE_FORMAT(updateat, '%d/%m/%Y à %Hh%imin%ss') AS date FROM " .$table. " WHERE id_article = ?");
        $req->execute(array($id));

        while ($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new $obj($data);  
            
        }
        return $var;
        $req->closeCursor();  
        
        
    }


    protected function deleteOne($table, $id){
        $this->getBdd();  
        $req = self::$_bdd->prepare("DELETE FROM $table WHERE id_article = $id");
        $req->execute(array());

    } 

    protected function createOne($table, $obj){
        $this->getBdd();
        $req = self::$_bdd->prepare("INSERT INTO ".$table." (title, content, updateat) VALUES (?, ?, ?)");
        $req->execute(array($_POST['title'], $_POST['content'], date("d.m.Y")));

        $req->closeCursor();
    }

     protected function updateOne($table, $id){
        //$this->getBdd();
        //$req = self::$_bdd->prepare();
        //$req->execute(array($));

        //$req->closeCursor();
    }   

}