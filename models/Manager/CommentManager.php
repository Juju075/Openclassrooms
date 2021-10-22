<?php
namespace Manager;

use Tools\Model;

class CommentManager extends Model
{
   //id article deja en session return $var[]
   public function getComments(){
      return $this->getAllComments();
   }
   public function displaynumber($comments){
      return $this->getCommentsCount($comments);
   }
   public function getOneComment($id){
      return $this->GetOne('comment','Comment', $id);
   }
   public function addComment($comment){
      //verification si connecte
      echo('|CommentManager createComment');
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
      $this->getBdd();
      $req  = self::$_bdd->prepare('SELECT id_comment FROM comment WHERE id_user = ? AND id_comment = ?'); 
      $req->execute(array($_SESSION['id_user'], $id_comment));
      $result = $req->fetchall();

      if(!empty($result)){
         return true;
      }
      return false;
   }



   public function deleteThisComment(){
      return $this ->deleteOneComment('comment');
   }
   public function validationByAdmin($id_comment, $token){
      return $this ->commentValidation($id_comment, $token);
   }

}


