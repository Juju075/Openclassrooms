<?php
namespace Manager;

use Tools\Model;

class CommentManager extends Model
{
   public function getComments($id){
      return $this->getAllComments('comment',$id);
   }

   public function getOneComment($id){
      return $this->GetOne('comment','Comment', $id);
   }
   public function createComment(){
      echo('| CommentManager.php createComment');
      return $this->CreateOneComment('comment');
   } 










}


