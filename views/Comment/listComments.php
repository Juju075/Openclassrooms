<?php
        use Manager\CommentManager;
        echo('Debut de script php');
        //     $this->_commentManager = new CommentManager;
        //     $comments = $this->_commentManager->getComments($_GET['id_article']); // un tableau return $var


        <!-- -->
        
					foreach ($comments as $comment):
				?>
          <!--  foreach Article id_article need id_user->fullName & content -->
            <div class="comment">
              <div class="post-info">
                <div class="left-area">
              <!-- Avatar -->    
                  <a class="avatar" href="#"><img src="public/images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                </div>
                <div class="middle-area">
              <p>variable content</p>
              <!-- getFullName -->
              <a class="name" href="#"><?= $comment->id_user() ?></a>
              <!-- date de creation -->
              <h6 class="date">on <?= $comment->createdAt() ?></h6>

                </div>
                <div class="right-area">
                    <h5 class="reply-btn" ><a href="comment&status=update"><b>MODIFIER</b></a></h5>
                    <h5 class="reply-btn" ><a href="comment&status=delete&id_comment=<?= ici ?>"><b>SUPPRIMER</b></a></h5>
                </div>
              </div>

              <!-- content -->
              <?= $comment->content() ?>               
            </div>
          <!-- Fin de l'iteration -->
        <?php endforeach ?>