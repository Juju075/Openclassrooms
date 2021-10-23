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
   public function updateArticle($content){
      $this->updateOne('article', $content);
   }
    public function articleAlreadyExist($title, $content){
      return $this->noDuplicatePost('article', $title, $content);
   }  


   public function articleVerif(){ 
        //lister les id articles encours.
            $this->getBdd();
            $req0  = self::$_bdd->prepare('SELECT id_article FROM article WHERE id_article = ?'); 
            $req0->execute(array($_SESSION['id_article']));
            $idArticle = $req0->fetchall();
            if(!empty($idArticle )){
                return true;
            }else{
                return false;
            }
   }

      public function articleVerifNote(){ 
            $this->getBdd();
            $req0  = self::$_bdd->prepare('SELECT id_article FROM article WHERE id_article = ?'); 
            $req0->execute(array($_SESSION['id_article']));
            return $req0->fetchall();
   }

   
}