<div class="slider"></div> 
<b>views/Post/viewAcceuil.php</b>
	<section class="blog-area section">
		<div class="container">
			<div class="row">
				<?php
					//foreach ($array as $value)
					foreach ($articles as $article):
				?>
				
					<div class="col-lg-4 col-md-6">
						<div class="card h-100">
							<div class="single-post post-style-1">
								<div class="blog-image"><img src="public/images/marion-michele-330691.jpg" alt="Blog Image"></div>
							
								<!-- retrouver l'avatar de l'id user grace a la fk de l'article 
							l'utilisateur doit etre connecter pour attribuer son id
							-->
								<div class="avatar"><img src="public/images/icons8-team-355979.jpg" alt="Profile Image"></div> 
								


								<div class="blog-info">
									<h4 class="title"><a href="post&id_article=<?= $article->getId_article() ?>"><b><?= $article->getTitle() ?></b></a></h4>
									<h6><p>ici chapo</p><?= $article->getChapo() ?></h6>
								 
									
								</div><!-- blog-info -->



							</div><!-- single-post -->
						</div><!-- card -->
					</div><!-- col-lg-4 col-md-6 -->
				<!-- Fin de l'iteration -->	
				<?php endforeach ?>
				
			</div><!-- row -->
		</div><!-- container -->
	</section><!-- section -->


	