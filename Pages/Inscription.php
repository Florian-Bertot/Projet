<?php 
	if (isset($_SESSION['site']) and $_SESSION['site'] == 'SHLML'){
		echo '	<br/><br/><h1> Inscription </h1>

				<p class = "lead">
					Vous êtes déjà connecté.<br/>
					Vous pouvez revenir à l\'accueil <a href="Structure.php?page=accueil">ici</a>.
				</p>
			 ';
	} else {
		?>

		<br/><br/><h1>Inscription</h1>

		<p class ="lead">
			Pour vous inscrire, merci de bien vouloir renseigner les champs suivants :
		
			<p><form class = "form-horizontal" role="form" method="post"  action="structure.php?page=inscription">
				<div class="form-group">
					<label class="control-label col-sm-2" for="nom">Nom :</label>
					<div class="col-sm-10">
						<input type = "text" name = "nom" id = "nom" maxlength=32 required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="prenom">Prenom :</label>
					<div class="col-sm-10">
						<input type = "text" name = "prenom" id = "prenom" maxlength=32 required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="email">Email :</label>
					<div class="col-sm-10">
						<input type = "email" name = "email" id = "email" maxlength=64 required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="password">Mot de passe :</label>
					<div class="col-sm-10"> 
						<input type="password" name = "password" id ="password" maxlength=32 required>
					</div>
				</div>
				<div class="form-group"> 
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name = "inscription" >OK</button>
					</div>
				</div>
			</form>
			</p>				
		</p>

	<?php } 


	if (isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['email']) and isset($_POST['password'])){
		if (strpos($_POST['email'],"@")==false) {
			echo '<p class="lead">L\'inscription n\'a pas pu s\'effectuer. <br/>Veuillez renseigner une adresse mail avec un format correct.</p>';
		} elseif (recherche_mail($_POST['email'])){
			echo '<p class="lead">L\'inscription n\'a pas pu s\'effectuer. <br/>Cette adresse mail est déjà utilisée. Veuiller renseigner une autre adresse mail.</p>';
		} elseif (strlen($_POST['password'])<6) {
			echo '<p class="lead">L\'inscription n\'a pas pu s\'effectuer. <br/>Veuillez renseigner un mot de passe contenant au moins 6 caractères.</p>';
		} else {
			insertion($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password']);

		}
	} 


 ?>
















































