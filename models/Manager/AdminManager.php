<?php
namespace Manager;

use Tools\Model;

class AdminManager extends Model
{

    //refactoring Article Comment User
    public function countEntity($table, $number){
        $result = [];
        $this->getBdd();

        if($table === 'Articles'){
            $req  = self::$_bdd->prepare('SELECT id_article FROM article'); 
            $req->execute();
        }
        elseif($table === 'Comments'){
            $req  = self::$_bdd->prepare('SELECT id_comment FROM comment WHERE disabled = ?');
            $req->execute(array($number));
        }
        elseif($table === 'Users'){
            $req  = self::$_bdd->prepare('SELECT id_user FROM user');
            $req->execute();
        }
        $result = count($req->fetchall());
    }
    


    public function commentsToValide(){
        $result = [];
        $this->getBdd();
        $req  = self::$_bdd->prepare('SELECT * FROM comment WHERE disabled = 0'); 
        $req->execute();
        $req->fetchall();   
    }

}