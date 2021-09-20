<?php
namespace Manager;
use Tools\Model;
use View\View;


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

   //Admin delete post
   public function deleteArticle($id){
      return $this->deleteOne('article', $id);
   }
   
   
   //Admin modification post > + page de modification
   public function updateArticle($id){
      echo('ArticleManager updateArticle');
      return $this->updateOne('article', $id);
   }
}