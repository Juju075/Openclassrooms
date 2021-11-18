<?php
namespace Manager;

use Tools\Model;
use Tools\Security;

class CommentManager extends Model
{
   public function getComments($display){
        $result = [];
        $this->getBdd();
        $req0  = self::$_bdd->prepare('SELECT id_comment FROM comment WHERE id_article = ?'); 
        $req0->execute(array($_SESSION['id_article']));
        $result = $req0->fetchall();
        if(!empty($result)){
            $var= [];
            $req  = self::$_bdd->prepare('SELECT comment.id_comment, comment.content, comment.createdat, comment.id_user, user.avatar FROM comment, user WHERE comment.id_article = ? AND comment.disabled = ? AND user.id_user = comment.id_user'); 
            $req->execute(array($_SESSION['id_article'],$display));
            $var = $req->fetchall();
                return $var; 
        }else{}
   }

   public function displaynumber($comments){
        if(isset($comments) && $comments !== null){
           return count($comments);
        }else{
            return 0;
        }
   }
   public function getOneComment($id){
      return $this->GetOne('comment','Comment', $id);
   }
   public function addComment($comment){
      return $this->createOne('comment', $comment);
   } 
   public function addCommentRequest($moderator){
      return $this->createOne('moderator', $moderator);
   } 

   public function addCommentRequestSkipGetOne($array){
      $id_comment = $array['id_comment'];
      $link = $array['link'];
      $erase = $array['erase'];

      $this->getBdd(); 
      $req = self::$_bdd->prepare('INSERT INTO moderator (link, id_comment, erase) VALUES (?, ?, ?) ');
      $req->execute(array($link, $id_comment, $erase));
      return true;  
   }

   public function updateComment($id_comment){
      $this->getBdd();
      $req  = self::$_bdd->prepare('UPDATE comment SET content = ? WHERE id_user = ? AND id_comment = ?'); 
      $req->execute(array($_POST[''], $_SESSION['id_article']), $id_comment);
      $result = $req->fetchall();  
      $req->closeCursor();    
   }


   public function verifCommentAuthor($id_comment){
      if(($user=Security::retrieveUserObj($_SESSION['user']['usertype']))!==null){
         if ($_SESSION['user']['usertype'] === 'ADMIN') {
            return true;
         }elseif ($_SESSION['user']['usertype'] === 'MEMBRE') {
            $this->getBdd();
            $req  = self::$_bdd->prepare('SELECT id_comment FROM comment WHERE id_user = ? AND id_comment = ?'); 
            $req->execute(array($_SESSION['id_user'], $id_comment));
            $result = $req->fetchall();
            if(!empty($result)){
               return true;
               }
               return false;   
         }
      }else{
         //retour au poste
      }
   }

   public function deleteOneComment($id_comment){
      var_dump($id_comment);
         $this->getBdd();
         $req  = self::$_bdd->prepare('DELETE FROM comment WHERE id_comment =?'); 
         $req->execute(array($id_comment));
         $req->closeCursor();
   }

   public function validationByAdmin($id_comment, $token){
        $this->getBdd();  
        $req = self::$_bdd->prepare("SELECT id_user  FROM user WHERE validation_key = ?");
        $req->execute(array($token)); 
        $user = $req->fetch();
        
        if(isset($user) && $user !== null){
            $req = self::$_bdd->prepare("SELECT id_user, id_article  FROM comment WHERE id_comment = ?");
            $req->execute(array($id_comment)); 
            $result = $req->fetchall();
            $req->closeCursor(); 

            if ($result[0]['id_user'] == $user[0]){
               $req = self::$_bdd->prepare("UPDATE comment SET disabled = 1 WHERE id_comment = ?");
               $req->execute(array($id_comment));
               $req->closeCursor(); 

               return $result[0]['id_article'];  
            }else{
                return null;
            }
        }else{
            return null;
        }
   }

   public function storeCommentUpdate0($content, $id_comment){
      $this->getBdd(); 
      $req = self::$_bdd->prepare("UPDATE comment SET content = ? , disabled = 0  WHERE id_comment = ?");
      $req->execute(array($content, $id_comment));
      $req->closeCursor();
      header('location: post&id_article='.$_SESSION['id_article']);
   }

   public function retriveIdComment($arraycondition){
      $this->getBdd($arraycondition); 
      $req = self::$_bdd->prepare('SELECT id_comment FROM comment WHERE id_user = ? AND id_article = ? AND content = ?');
      $req->execute(array($arraycondition[0], $arraycondition[1], $arraycondition[2]));
      $idComment = $req->fetch();
      $req->closeCursor();
      return $idComment;
   }



   








   public function verifUserCommentArticle(){
      $this->getBdd(); 
      $req = self::$_bdd->prepare('SELECT id_comment FROM comment WHERE id_article = ? AND id_user = ?');
      $req->execute(array($_SESSION['id_article'], $_SESSION['id_user']));
      $result = $req->fetch();
      $req->closeCursor(); 

      if(empty($result)){
         return true;
      }else{
         return false;
      }
   }

   public function retrieveToken(){
      $this->getBdd(); 
      $req = self::$_bdd->prepare('SELECT validation_key FROM user WHERE id_user = ?');
      $req->execute(array($_SESSION['id_user']));
      $result = $req->fetch();
      $req->closeCursor();    
      return $result['validation_key'];
   }
}
