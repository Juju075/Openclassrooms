    <?php ?>
    <h1 class="my-5 text-center">Ajouter un utilisateur.</h1>

        <form method="post" action="register&status=new">
            <div class="row">
                    <div class="col-md-6"><label for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="username">
                    </div>
                    <div class="col-md-6"><label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div class="col-md-6"><label for="prenom">Prénom</label>
                        <input type="text" class="form-control" name="prenom" placeholder="First name">
                    </div>
                    <div class="col-md-6"><label for="nom">Nom</label>
                        <input type="text" class="form-control" name="nom" placeholder="Last name">
                    </div>
                    <div class="col-md-6"><label for="checkpassword">Password verification</label>
                        <input type="password" class="form-control" name="checkpassword" placeholder="First name">
                    </div>
                    <div class="col-md-6"><label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="email@example.com">
                    </div>


<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01">Upload Avator or logo.</span>
  </div>
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
  </div>
</div>


                    <div class="button"><button type="submit" class="btn btn-primary btn-lg btn-block">Soumettre</button></div>               
            </div>
		</form>
