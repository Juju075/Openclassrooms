<?php
namespace Manager;
use Tools\Model;

class AdminManager extends Model
{
    public function countArticles(){
        $result = [];
        $this->getBdd();
        $req  = self::$_bdd->prepare('SELECT id_article FROM article'); 
        $req->execute();
        $result = count($req->fetchall());
    }
    public function countComments(int $number){
        $result = [];
        $this->getBdd();
        $req  = self::$_bdd->prepare('SELECT id_comment FROM comment WHERE disabled = ?'); 
        $req->execute($number);
        $result = count($req->fetchall());
    }
    public function countUsers(){
        $result = [];
        $this->getBdd();
        $req  = self::$_bdd->prepare('SELECT id_user FROM user'); 
        $req->execute();
        $result = count($req->fetchall());
    }

}