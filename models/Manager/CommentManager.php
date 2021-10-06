<?php
namespace Manager;

use Tools\Model;

class CommentManager extends Model
{
   //id article deja en session return $var[]
   public function getComments(){
      return $this->testGetAllComments();
   }

   public function getOneComment($id){
      return $this->GetOne('comment','Comment', $id);
   }
   public function addComment($comment){
      echo('|CommentManager createComment');
      return $this->createOne('comment', $comment);
   } 
      public function testGetComments(){
      return $this->testGetAllComments('comment');
   }

   public function deleteThisComment(){
      return $this ->deleteOneComment('comment');
   }
   public function validationByAdmin($id_comment, $token){
      return $this ->commentValidation($id_comment);
   }









}


