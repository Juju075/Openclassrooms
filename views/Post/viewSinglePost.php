<div class="slider">
  <div class="display-table  center-text">
    <h1 class="title display-table-cell"><b>PROJET OPENCLASSROOM BLOG MVC</b></h1>
  </div>
</div><!-- slider -->

<section class="post-area section">
  <div class="container">

    <div class="row">

      <div class="col-lg-8 col-md-12 no-right-padding">

        <div class="main-post">

          <div class="blog-post-inner">

            <div class="post-info">

              <div class="left-area">
                <!-- Avatar img-->
                <a class="avatar" href="#"><img src="public/images/avatar-1-120x120.jpg" alt="Profile Image"></a>
              </div>

              <div class="middle-area">
                <p>twig prenom</p> <p>twig nom</p> <p>twig latest modification</p>
                <h6 class="date">on Sep 29, 2017 at 9:48 am</h6> 
              </div>

            </div><!-- post-info -->

            <? var_dump($article);?>

            <h3 class="title"><a href="#"><b><?=$article[0]->getTitle()?></b></a></h3>

            <p class="para"><?=$article[0]->getContent()?></p>



            <ul class="tags">
              <p>Admin uniquement</p>

              <!-- Recupere Get-->
              <li><a href="post&delete=<? $_GET['id_article']?>">Supprimer</a></li> <!-- post&delete-->
              <li><a href="post&update=<? $_GET['id_article']?>">Modifier</a></li> <!-- post&update -->
            </ul>
          </div><!-- blog-post-inner -->

          <div class="post-icons-area">
            <ul class="icons">
              <li>SHARE : </li>
              <li><a href="#"><i class="ion-social-facebook"></i></a></li>
              <li><a href="#"><i class="ion-social-twitter"></i></a></li>
              <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
            </ul>
          </div>

        </div><!-- main-post -->
      </div><!-- col-lg-8 col-md-12 -->



      <div class="col-lg-4 col-md-12 no-left-padding">
        <div class="single-post info-area">

          <div class="sidebar-area about-area">
            <h4 class="title"><b>PROJET BLOG MVC</b></h4>
            <p>Ce blog est construit autour d'une architecture PHP MVC.<br><br>
          Retouvez la documentation sur github<b>
          </b></p>
        <a href="https://github.com/Juju075/Openclassrooms">https://github.com/Juju075/Openclassrooms</a>
          </div>
        </div><!-- info-area -->
      </div><!-- col-lg-4 col-md-12 -->

      

    </div><!-- row -->

  </div><!-- container -->
</section><!-- post-area -->

<!-- =================================================================== -->
<!-- -->
<!-- =================================================================== -->

<section class="comment-section">
  <div class="container">
    <p>UNIQUEMENT SI ROLE UTILISATEUR</p> 
    <p>VALIDATION PAR L ADMINISTRATEUR</p>
    <h4><b>AJOUTER UN COMMENTAIRE</b></h4>
    <div class="row">

      <div class="col-lg-8 col-md-12">
        <div class="comment-form">


    <!-- =================================================================== -->
    <!-- Formulaire --> <!-- Recuperer GET id de l'article -->
    <!-- =================================================================== -->    
    recuperer id_article<br>
    ajouter id_user
   <?= $id ='';?>

          <form method="post" action="comment&status=new">
            <div class="row">
              <div class="col-sm-12">
                <textarea name="comment" rows="2" class="text-area-messge form-control"
                  placeholder="Ajouter votre commentaire" aria-required="true" aria-invalid="false"></textarea >
              </div><!-- col-sm-12 -->
              <div class="col-sm-12">
                <button class="submit-btn" type="submit" id="form-submit"><b>ENVOYER</b></button>
              </div><!-- col-sm-12 -->
            </div><!-- row -->
          </form>
    <!-- =================================================================== -->
    <!-- Fin formulaire  -->
    <!-- =================================================================== -->          
        </div><!-- comment-form -->

        <h4><b>COMMENTAIRES</b></h4>
        FOREACH COMMENT FOR ARTICLE ID 
    <!-- =================================================================== -->
    <!-- Affichage commentaires -->
    <!-- =================================================================== -->  
        <div class="commnets-area">


        <!-- Exemple comment -->
        Exemple:
          <div class="comment">

            <div class="post-info">

              <div class="left-area">
                <a class="avatar" href="#"><img src="public/images/avatar-1-120x120.jpg" alt="Profile Image"></a>
              </div>

              <div class="middle-area">
                <a class="name" href="#"><b>Katy Liu</b></a>
                <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
              </div>

              <div class="right-area">
                <h5 class="reply-btn" ><a href="#"><b>DELETE</b></a></h5>
                <h5 class="reply-btn" ><a href="#"><b>UPDATE</b></a></h5>
              </div>

            </div><!-- post-info -->

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
              ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
              Ut enim ad minim veniam</p>
          </div>
        <!-- Fin exemple comment -->
<!-- $comment = Model getAllComments -->
{% include "listComments.php" %}


        </div><!-- commnets-area -->



      </div><!-- col-lg-8 col-md-12 -->
    </div><!-- row -->
  </div><!-- container -->
</section>