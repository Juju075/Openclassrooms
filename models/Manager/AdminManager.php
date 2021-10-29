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
        return count($req->fetchall());
    }
    

    public function getCommentToValidate(){
        $this->getBdd();
        $req = self::$_bdd->prepare('SELECT id_comment FROM comment WHERE disabled = 0');    
        $req->execute();
        $idComments = $req->fetchall();

        $i = 0;
        while (!empty($idComments[$i][$i])) {
            $cards = [];
            $req = self::$_bdd->prepare('SELECT id_article FROM comment WHERE id_comment = ?');
            $req->execute(array($idComments[$i][$i]));
            $idArticle = $req->fetch();
            
            $req = self::$_bdd->prepare('SELECT id_user FROM comment WHERE id_comment = ?');
            $req->execute(array($idComments[$i][$i]));
            $idUser = $req->fetchall();
            
            $req = self::$_bdd->prepare('SELECT title FROM article WHERE id_article = ?');
            $req->execute(array($idArticle[0]));
            $title = $req->fetchall();
            
            $req = self::$_bdd->prepare('SELECT content FROM comment WHERE id_comment = ?');
            $req->execute(array($idComments[$i][$i]));
            $content = $req->fetchall();
            
            $req = self::$_bdd->prepare('SELECT prenom, nom FROM user WHERE id_user = ?');
            $req->execute(array($idUser[0][0]));
            $fullName = $req->fetch();
            
            $req = self::$_bdd->prepare('SELECT link FROM moderator WHERE id_comment = 160');
            $req->execute(array($idComments[$i][$i]));
            $link = $req->fetch();

            $req = self::$_bdd->prepare('SELECT createdat FROM moderator WHERE id_comment = 160');
            $req->execute(array($idComments[$i][$i]));
            $date = $req->fetch();            
                    
            $cards = array($title[0]['title'], $content[0]['content'], $fullName['prenom'],$fullName['nom'], $link['link'], $date['date']);
            $i++;   
        }
    return $cards;
    }
}
