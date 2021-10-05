<?php
namespace Manager;

use Tools\Model;

class CommentManager extends Model
{
   //return $var[]
   public function getComments(){
      return $this->getAllComments('comment');
   }

   public function getOneComment($id){
      return $this->GetOne('comment','Comment', $id);
   }
   public function createComment($comment){
      echo('|CommentManager createComment');
      return $this->CreateOneComment('comment', $comment);
   } 
      public function testGetComments(){
      return $this->testGetAllComments('comment');
   }

   public function deleteThisComment(){
      return $this ->deleteOneComment('comment');
   }










}


