<?php
namespace Manager;

use Tools\Model;


class ArticleManager extends Model
{
   public function getArticles(){
      return $this->getAll('article','Article');
   }

   public function getArticle($id){
      return $this->getOne('article','Article', $id);
   }
   public function createArticle($article){
      return $this->CreateOne('article',$article);
   } 

   //Admin delete post
   public function deleteArticle($id){
     $this->deleteOne('article', $id);
   }
   public function updateArticle($id, $content){
      echo('| ArticleManager updateArticle');
      return $this->updateOne('article', $id, $content);
   }
    public function articleAlreadyExist($title, $content){
      echo('| ArticleManager articleAlreadyExist');
      var_dump($title. $content);
      return $this->noDuplicatePost('article', $title, $content);
   }  


   public function roleverif(){
     echo('| ArticleManager roleverif'); 
     return $this->roleVerification();
   } 
   public function articleVerif(){ //effacer cette fonction non utilise.
      echo('| ArticleManager articleVerif');
      return $this->postIfExist();
   }
}