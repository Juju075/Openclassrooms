    <?php ?>
    <h1 class="my-5 text-center">Ajouter un utilisateur.</h1>

        <form method="post" action="register&status=new">
            <div class="row">
                    <div class="col-md-6"><label for="username">Username</label><input type="text"name="username"></div>
                    <div class="col-md-6"><label for="password">password</label><input type="text"name="password"></div>
                    <div class="col-md-6"><label for="prenom">prenom</label><input type="text"name="prenom"></div>
                    <div class="col-md-6"><label for="prenom">nom</label><input type="text"name="nom"></div>
                    <div class="col-md-6"><label for="checkpassword">checkpassword</label><input type="text"name="checkpassword"></div>
                    <div class="col-md-6"><label for="email">email</label><input type="text"name="email"></div>
                    <div class="button"><button type="submit">Soumettre</button></div>               

            </div>
		</form>