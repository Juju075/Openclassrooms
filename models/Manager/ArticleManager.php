<?php

require_once('framework/Model.php'); // à enlever bizarre

class ArticleManager extends Model
{
   public function getArticles(){
      return $this->getAll('article','Article');
   }

   public function getArticle($id){
      return $this->GetOne('article','Article', $id);
   }
   public function createArticle(){
      return $this->CreateOne('article','Article');
   } 

   public function deleteArticle($id){

      return $this->deleteOne('article', $id);
   
   }
   public function update($id){

   }
}