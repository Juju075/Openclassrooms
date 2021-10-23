<?php
namespace Manager;
use Tools\Model;

class ContactManager extends Model
{

   public function getUser($id){
       echo('ContactManager getUser');
      return $this->GetOne('user','User', $id);
   }

      public function testComment($id){
       echo('ContactManager testComment');
      return $this->GetOne('comment','Comment', $id);
   }
}