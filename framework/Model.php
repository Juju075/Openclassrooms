<?php
namespace Tools;

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
        }
    }

    protected function getBdd(){
        if(self::$_bdd === null){
            self::setBdd();
        }
        return self::$_bdd;
    }


    protected function getAll($table, $obj){
        $this->getBdd();
        $var = [];
        $id='id_'.$table;
        switch($table)
        {
            case 'article':
                $sql = 'SELECT * FROM article ORDER BY :id desc';
                break;
            case 'comment':
                $sql = 'SELECT * FROM comment ORDER BY :id desc';
                break;
        }
        $req  = self::$_bdd->prepare($sql);  //binparam
        $req->bindValue(':id', $id);
        $req->execute();

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)){
            $obj2="\\Entity\\".$obj;
            $var[] = new $obj2($data);
        }
        return $var;
        $req->closeCursor();
    }
       
    protected function getAllComments(){
        $result = [];
        $this->getBdd();
        $req0  = self::$_bdd->prepare('SELECT id_article FROM comment WHERE id_article = ?'); 
        $req0->execute(array($_SESSION['id_article']));
        $result = $req0->fetchall();
          
        if(!empty($result)){
                $var= [];
                $req  = self::$_bdd->prepare('SELECT id_comment, content, createdat, id_user FROM comment WHERE id_article = ?'); 
                $req->execute(array($_SESSION['id_article']));
                $var = $req->fetchall();
                return $var; 
        }else{}
        
    }

    protected function authenticationRequest($obj,$usertype){
        $this->getBdd();
        $req = self::$_bdd->prepare('SELECT id_user, password, activated, usertype FROM user WHERE username = ?');
        $req->execute(array($obj['username']));
        $resultat = $req->fetch();

            if ($resultat !== false) {
                $Verif_pass = password_verify(htmlspecialchars($obj['password']), $resultat['password']);
                
                    if ($Verif_pass == TRUE && $resultat['activated'] == 1 && $resultat['usertype']==$usertype){
                        $id_user = $resultat['id_user'];
                        $_SESSION['id_user']=$id_user;  

                        $user=$this->getOne('user','User',$id_user); 
                        return $user;
                    }
                    else{
                        return false;
                    }  
            }elseif($resultat === false){

                return false;
            }  
    }

    protected function postIfExist(){
        $this->getBdd();
        $req0  = self::$_bdd->prepare('SELECT id_article FROM article WHERE id_article = ?'); 
        $req0->execute(array($_SESSION['id_article']));
        return $req0->fetchall();
    }

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





    protected function getOne($table, $obj, $id){ 
        $this->getBdd();
        switch($obj){
            case 'Article':
            $req = self::$_bdd->prepare("SELECT id_article, title, content, DATE_FORMAT(updatedAt, '%d/%m/%Y ?? %Hh%imin%ss') AS date FROM article WHERE id_article = ?");
            break;
            case 'User':
            $req = self::$_bdd->prepare("SELECT * FROM user WHERE id_user= ?");
            break;
            case 'Comment':
            $req = self::$_bdd->prepare("SELECT * FROM comment WHERE id_comment = ?");
            break;                        
        }
        $req->execute(array($id));
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)){
            $obj2="\\Entity\\".$obj;
            $var = new $obj2($data); 
        }
        return $var;  
    }




    protected function deleteOne($table, $id){
        $this->getBdd();  
        $req = self::$_bdd->prepare("DELETE FROM $table WHERE id_article = $id");
        $req->execute(array($id));
    } 
}
