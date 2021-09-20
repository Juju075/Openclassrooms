<div class="container-contact100">
		<div class="wrap-contact100">
<!-- Prepopule avec la var id -->
			<form  method="post" action="post&update_id=<?$_GET['id_article'] ?>" class="contact100-form validate-form">
				<span class="contact100-form-title">
					Modifier un Article! ici
				</span>

				<div class="" data-validate="Title is required">
					<span class="">Titre</span>
					<input class="" type="text" name="title" value="<?php echo('prepopuler le titre'); ?>" > 
					<span class=""></span>
				</div>
				<div class="" data-validate="Chapo is required">
					<span class="">Chapo</span>
					<input class="" type="text" name="chapo"  value="<?php echo('prepopuler le chapo'); ?>">
					<span class=""></span>
				</div>
				<div class="" data-validate = "Contenu is required">
					<span class="">Contenu de l'Article</span>
					<textarea class="" name="content"><?php echo('prepopuler le chapo'); ?></textarea>
					<span class=""></span>
				</div>

				<div class="">
					<div class="">
						<div class=""></div>
						<button class="">
							<span>
								Soumettre
								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>