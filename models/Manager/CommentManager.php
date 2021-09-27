<?php
namespace Manager;

use Tools\Model;

class CommentManager extends Model
{
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










}


