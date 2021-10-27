<?php
namespace Manager;
use Tools\Model;

class ContactManager extends Model
{
   public function getUser($id){
      return $this->GetOne('user','User', $id);
   }

   public function testComment($id){
   return $this->GetOne('comment','Comment', $id);
   }
}
