			<ul class="main-menu visible-on-click" id="main-menu">
				<!-- Twig si non connecte -->
				<li><a href="register&create">S'inscrire</a></li>
				<li><a href="login&user">S'authentifier</a></li>				
				<!-- Twig -->
				<li><a href="profile">Mon profil</a></li>
				<li><a href="accueil">Listing des articles</a></li>
				
				<!-- Twig si connecte as Admin-->
				{% if user == 'ADMIN' %}
				<li><a href="post&create">Créer un article</a></li>
				{% endif %}
				<li><a href="contact&create">Nous contacter</a></li>
				<li><a href="login&logout">Me deconnecter</a></li>
				
			</ul><!-- main-menu -->