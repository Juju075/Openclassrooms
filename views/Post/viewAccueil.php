<div class="slider"></div> 

	<section class="blog-area section">
		<div class="container">
			<div class="row">
				<?php
					foreach ($articles as $article):
				?>
				
					<div class="col-lg-4 col-md-6">
						<div class="card h-100">
							<div class="single-post post-style-1">
								<div class="blog-image"><img src="public/images/marion-michele-330691.jpg" alt="Blog Image"></div>
								<a class="avatar" href="#"><img src="public/images/icons8-team-355979.jpg" alt="Profile Image"></a>
								<div class="blog-info">
									<h4 class="title"><a href="post&id_article=<?= $article->id_article() ?>"><b><?= $article->title() ?></b></a></h4>


									<h6><p>ici le chapo.</p><? $article->chapo() ?></h6>
									<h6><? $article->created_date() ?></h6>
								</div><!-- blog-info -->
							</div><!-- single-post -->
						</div><!-- card -->
					</div><!-- col-lg-4 col-md-6 -->
				<?php endforeach ?>
				
			</div><!-- row -->
		</div><!-- container -->
	</section><!-- section -->


	