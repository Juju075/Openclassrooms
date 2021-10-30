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
        $cards = [];
        $this->getBdd();
        $req = self::$_bdd->prepare('SELECT id_comment FROM comment WHERE disabled = 0');    
        $req->execute();
        $idComments = $req->fetchall();
        var_dump($idComments);
        
        $i = 0;
        while (!empty($idComments[$i]['id_comment'])) {
            $req = self::$_bdd->prepare('SELECT id_article FROM comment WHERE id_comment = ?');
            $req->execute(array($idComments[$i][$i]));
            $idArticle = $req->fetch();
            
            $req = self::$_bdd->prepare('SELECT id_user FROM comment WHERE id_comment = ?');
            $req->execute(array($idComments[$i][$i]));
            $idUser = $req->fetch();
                     
            $req = self::$_bdd->prepare('SELECT title FROM article WHERE id_article = ?');
            $req->execute(array($idArticle['id_article']));
            $title = $req->fetch();
                       
            $req = self::$_bdd->prepare('SELECT content FROM comment WHERE id_comment = ?');
            $req->execute(array($idComments[$i][$i]));
            $content = $req->fetch();
            
            $req = self::$_bdd->prepare('SELECT prenom, nom FROM user WHERE id_user = ?');
            $req->execute(array($idUser['id_user']));
            $fullName = $req->fetch();
                      
            $req = self::$_bdd->prepare('SELECT link FROM moderator WHERE id_comment = 160');
            $req->execute(array($idComments[$i][$i]));
            $link = $req->fetch();
             
            $req = self::$_bdd->prepare('SELECT createdat FROM moderator WHERE id_comment = 160');
            $req->execute(array($idComments[$i][$i]));
            $date = $req->fetch();  
                    
            $cards = array('title'=>$title['title'],'content'=>$content['content'],'prenom'=>$fullName['prenom'],'nom'=>$fullName['nom'],'link'=>$link['link'],'createdat'=>$date['createdat']);
            
        $i++;
        return $cards;
        }
    }



    public function getCommentToValidateBackup(){
        $this->getBdd();
        $req = self::$_bdd->prepare('SELECT id_comment FROM comment WHERE disabled = 0');    
        $req->execute();
        $idComments = $req->fetchall();

        var_dump($idComments);
        var_dump($idComments[0]['id_comment']);
   

        $i = 0;
        while (!empty($idComments[$i][$i])) { //recupere le string
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
                   
            $cards = array('title'=>$title[0]['title'], 'content'=>$content[0]['content'], 'prenom'=>$fullName['prenom'], 'nom'=>$fullName['nom'], 'link'=>$link['link'], 'date'=>$date['date']);
            $i++;   
        }
    return $cards;
    }
}
