<?php

require_once('framework/Model.php'); // à enlever bizarre

class ArticleManager extends Model
{
   public function getArticles(){
      return $this->getAll('articles','Article');
   }

   public function getArticle($id){
      return $this->GetOne('articles','Article', $id);
   }
   public function createArticle(){
      return $this->CreateOne('articles','Article');
   } 

   public function deleteArticle($id){

      return $this->deleteOne('articles', $id);
   
   }
   public function update($id){

   }
}