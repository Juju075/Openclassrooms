<?php
namespace Manager;

use Tools\Model;

class CommentManager extends Model
{
   public function getComments(){
      return $this->getAllComments('comment','Comment');
   }

   public function getCommentdd($id){
      return $this->GetOne('comment','Comment', $id);
   }
   public function createComment(){
      echo('| CommentManager.php createComment');
      return $this->CreateOneComment('comment');
   } 










}


