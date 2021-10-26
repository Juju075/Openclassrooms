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

   public function updateArticle($id,$title,$content){ 
      //date de modification
      $updatedAt= date('d-m-Y').' '.time();
      $this->getBdd();  
      $req = self::$_bdd->prepare('UPDATE article SET title = ?, content = ?, updatedAt = ? WHERE id_article = ?');
      $req->execute(array($_POST['title'],$_POST['content'],$updatedAt, $_SESSION['id_article']));
      $req->fetch();
      $req->closeCursor(); 
   } 
        

   public function noDuplicatePost($title, $content){ 
      $titleresult[]='';
      $this->getBdd();
      $req = self::$_bdd->prepare("SELECT id_article FROM article WHERE title = ?");
      $req->execute(array($title));
      $titleresult = $req->fetchall(); 

      if (!empty($titleresult)) { 
         $req = self::$_bdd->prepare("SELECT content FROM article WHERE id_article = ?");
         var_dump($titleresult[0]);

         $req->execute(array($titleresult[0]));
         $contentresult = $req->fetchall(); 
            if ($contentresult === $content) {
               return true;
                  }
                  else{  
                     return false;
                  }
        }
        else{
            return false;
        }
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