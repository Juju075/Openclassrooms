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
                <a class="avatar" href="#"><img src="public/images/avatar-1-120x120.jpg" alt="Profile Image"></a>
              </div>

              <div class="middle-area">
                <a class="name" href="#"><b>Katy Liu</b></a> <!-- prenom nom-->
                <h6 class="date">on Sep 29, 2017 at 9:48 am</h6><!-- twig date aujourdhui-->
              </div>

            </div><!-- post-info -->

            <h3 class="title"><a href="#"><b><?=$article[0]->title()?></b></a></h3>

            <p class="para"><?=$article[0]->content()?></p>



            <ul class="tags">
              <li><a href="/post&delete">Supprimer</a></li> <!-- post&delete-->
              <li><a href="/post&update">Modifier</a></li> <!-- post&update -->
            </ul>
          </div><!-- blog-post-inner -->

          <div class="post-icons-area">
            <ul class="post-icons">
              <li><a href="#"><i class="ion-heart"></i>57</a></li>
              <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
              <li><a href="#"><i class="ion-eye"></i>138</a></li>
            </ul>

            <ul class="icons">
              <li>SHARE : </li>
              <li><a href="#"><i class="ion-social-facebook"></i></a></li>
              <li><a href="#"><i class="ion-social-twitter"></i></a></li>
              <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
            </ul>
          </div>

          <div class="post-footer post-info">

            <div class="left-area">
              <a class="avatar" href="#"><img src="public/images/avatar-1-120x120.jpg" alt="Profile Image"></a>
            </div>

            <div class="middle-area">
              <a class="name" href="#"><b>Katy Liu</b></a>
              <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
            </div>

          </div><!-- post-info -->


        </div><!-- main-post -->
      </div><!-- col-lg-8 col-md-12 -->

      <div class="col-lg-4 col-md-12 no-left-padding">

        <div class="single-post info-area">

          <div class="sidebar-area about-area">
            <h4 class="title"><b>PROJET BLOG MVC</b></h4>
            <p>Ce blog est construit autour d'une architecture PHP MVC.<br>
          Retouvez la documentation sur github<b>
          </b></p>
        <a>github ici</a>
          </div>


        </div><!-- info-area -->

      </div><!-- col-lg-4 col-md-12 -->

    </div><!-- row -->

  </div><!-- container -->
</section><!-- post-area -->

<section class="comment-section">
  <div class="container">
    <h4><b>AJOUTER UN COMMENTAIRE</b></h4>
    <div class="row">

      <div class="col-lg-8 col-md-12">
        <div class="comment-form">
          <form method="post">
            <div class="row">

              <div class="col-sm-6">
                <input type="text" aria-required="true" name="contact-form-name" class="form-control"
                  placeholder="Enter your name" aria-invalid="true" required >
              </div><!-- col-sm-6 -->
              <div class="col-sm-6">
                <input type="email" aria-required="true" name="contact-form-email" class="form-control"
                  placeholder="Enter your email" aria-invalid="true" required>
              </div><!-- col-sm-6 -->

              <div class="col-sm-12">
                <textarea name="contact-form-message" rows="2" class="text-area-messge form-control"
                  placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
              </div><!-- col-sm-12 -->
              <div class="col-sm-12">
                <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
              </div><!-- col-sm-12 -->

            </div><!-- row -->
          </form>
        </div><!-- comment-form -->

        <h4><b>COMMENTAIRES(12)</b></h4>

        <div class="commnets-area">

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
                <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
              </div>

            </div><!-- post-info -->

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
              ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
              Ut enim ad minim veniam</p>

          </div>

          <div class="comment">
            <h5 class="reply-for">Reply for <a href="#"><b>Katy Lui</b></a></h5>

            <div class="post-info">

              <div class="left-area">
                <a class="avatar" href="#"><img src="public/images/avatar-1-120x120.jpg" alt="Profile Image"></a>
              </div>

              <div class="middle-area">
                <a class="name" href="#"><b>Katy Liu</b></a>
                <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
              </div>

              <div class="right-area">
                <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
              </div>

            </div><!-- post-info -->

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
              ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
              Ut enim ad minim veniam</p>

          </div>

        </div><!-- commnets-area -->

        <div class="commnets-area ">

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
                <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
              </div>

            </div><!-- post-info -->

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
              ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
              Ut enim ad minim veniam</p>

          </div>

        </div><!-- commnets-area -->

        <a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>

      </div><!-- col-lg-8 col-md-12 -->

    </div><!-- row -->

  </div><!-- container -->
</section>