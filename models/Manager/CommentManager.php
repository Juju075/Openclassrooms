<?php
namespace Manager;

use Tools\Model;

class CommentManager extends Model
{
   public function getComments(){
      return $this->getAll('comment','Comment');
   }

   public function getComment($id){
      return $this->GetOne('comment','Comment', $id);
   }
   public function createComment(){
      return $this->CreateOneComment('comment');
   } 










}


