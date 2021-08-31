<?php
/**
 *
*/
abstract class Model
{
    protected static $_bdd;

    private static function setBdd(){
        self::$_bdd = new PDO('mysql:host=localhost;dbname=php_mvc;charset=utf8','root','');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getBdd(){
        if(self::$_bdd == null){
            self::setBdd();
            return self::$_bdd;
        }
    }

    protected function getAll($table, $obj){
        $this->getBdd();
        $var = [];

        $req  = self::$_bdd->prepare('SELECT * FROM '. $table.' ORDER BY id desc');  
        $req->execute();

        while ($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new $obj($data); // Instancie 'Article' avec les data.
        }

        return $var;
        $req->closeCursor(); //Fermeture de la connexion.
    }
    protected function getOne($table, $obj, $id){

        $this->getBdd();
        $var = [];
        $req = self::$_bdd->prepare("SELECT id, title, content, DATE_FORMAT(date, '%d/%m/%Y à %Hh%imin%ss') AS date FROM " .$table. " WHERE id = ?");
        $req->execute(array($id));

        while ($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new $obj($data);  
            
        }
        return $var;
        $req->closeCursor();  
        
        
    }
    protected function deleteOne($table, $id){
        $this->getBdd();  
    }   
    
    protected function createOne($table, $obj){
        $this->getBdd();
        $req = self::$_bdd->prepare("INSERT INTO ".$table." (title, content, date) VALUES (?, ?, ?)");
        $req->execute(array($_POST['title'], $_POST['content'], date("d.m.Y")));

        $req->closeCursor();
    }

    
    

}