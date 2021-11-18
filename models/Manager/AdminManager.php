<?php
namespace Manager;

use Tools\Model;

class AdminManager extends Model
{
    public function countEntity($table, $number){
        $result = [];
        $this->getBdd();

        switch ($table) {
            case 'Articles':
            $req  = self::$_bdd->prepare('SELECT id_article FROM article'); 
            $req->execute();
                break;
            case 'Comments':
            $req  = self::$_bdd->prepare('SELECT id_comment FROM comment WHERE disabled = ?');
            $req->execute(array($number));
                break;
            case 'Users':
            $req  = self::$_bdd->prepare('SELECT id_user FROM user');
            $req->execute();
                break;                
        }
        return count($req->fetchall());
    }
    public function getCommentToValidate(){
            $cards = [];
            $this->getBdd();
            $cards=[];    
            $req = self::$_bdd->prepare('SELECT article.title, comment.content, user.nom, user.prenom, moderator.link, moderator.createdat, moderator.erase FROM comment, user, article, moderator WHERE comment.id_article=article.id_article and user.id_user=comment.id_user and comment.id_comment=moderator.id_comment and comment.disabled = 0 ORDER BY moderator.createdat DESC');    
            $req->execute();
            $Comments = $req->fetchAll(\PDO::FETCH_ASSOC);
            $cards=$Comments;
            return $cards;
        }
        
    public function getCommentToValidateBackup(){
        $cards = [];
        $this->getBdd();
        $req = self::$_bdd->prepare('SELECT id_comment FROM comment WHERE disabled = 0');    
        $req->execute();
        $idComments = $req->fetchall();
        
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
                      
            $req = self::$_bdd->prepare('SELECT link FROM moderator WHERE id_comment = ?');
            $req->execute(array($idComments[$i][$i]));
            $link = $req->fetch();
             
            $req = self::$_bdd->prepare('SELECT createdat FROM moderator WHERE id_comment = ?');
            $req->execute(array($idComments[$i][$i]));
            $date = $req->fetch();  
                    
            $cards = array('id_article'=>$idArticle['id_article'],'title'=>$title['title'],'content'=>$content['content'],'prenom'=>$fullName['prenom'],'nom'=>$fullName['nom'],'link'=>$link['link'],'createdat'=>$date['createdat']);
            
        $i++;
        return $cards;
        }
    }
}
