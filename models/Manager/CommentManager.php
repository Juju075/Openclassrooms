<?php
namespace Manager;

use Tools\Model;
use Tools\Security;

class CommentManager extends Model
{
   //id article deja en session return $var[]
   public function getComments(){
        $result = [];
        $this->getBdd();
        $req0  = self::$_bdd->prepare('SELECT id_comment FROM comment WHERE id_article = ?'); 
        $req0->execute(array($_SESSION['id_article']));
        $result = $req0->fetchall();
        if(!empty($result)){
            $var= [];
            $req  = self::$_bdd->prepare('SELECT id_comment, content, createdat, id_user FROM comment WHERE id_article = ? AND disabled = 1'); 
            $req->execute(array($_SESSION['id_article']));
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

   public function updateComment($id_comment){
      $this->getBdd();
      $req  = self::$_bdd->prepare('UPDATE comment SET content = ? WHERE id_user = ? AND id_comment = ?'); 
      $req->execute(array($_POST[''], $_SESSION['id_article']), $id_comment);
      $result = $req->fetchall();  
      $req->closeCursor();    
   }

   public function verifCommentAuthor($id_comment){
   if(($user=Security::retrieveUserObj('ADMIN'))!==null){
      $this->getBdd();
      $req  = self::$_bdd->prepare('SELECT id_comment FROM comment WHERE id_user = ? AND id_comment = ?'); 
      $req->execute(array($_SESSION['id_user'], $id_comment));
      $result = $req->fetchall();
      if(!empty($result)){
         return true;
      }
      return false;
      }
      return false;   
   }


   public function deleteOneComment($id_comment){
      $this-> deleteOne('comment', $id_comment);
   }

   public function validationByAdmin($id_comment, $token){
        $this->getBdd();  
        //Est ce que le token est bien celui de l'utilisateur
        //
        $req = self::$_bdd->prepare("SELECT id_user  FROM user WHERE validation_key = ?");
        $req->execute(array($token)); 
        $user = $req->fetch();
        
        
        //Verifie si c bien l'auteur du comment
        if(isset($user) && $user !== null){
            $req = self::$_bdd->prepare("SELECT id_user, id_article  FROM comment WHERE id_comment = ?");
            $req->execute(array($id_comment)); 
            $result = $req->fetchall();
            $req->closeCursor(); 

            if ($result[0]['id_user'] == $user[0]){ // pb ici
                //valider l'affichage
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
      //envoie du email a l'admin
      header('location: post&id_article='.$_SESSION['id_article']);
   }

   public function retriveIdComment(){
      
   }
}


