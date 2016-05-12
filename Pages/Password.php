<?php 
if (!(isset($_SESSION['site']) and $_SESSION['site'] == 'SHLML')){
 ?>

<br/><br/>
<h1>Réinitialisation du mot de passe</h1>

<!-- TODO : Faire la page -->

	<p class="lead">Veuillez entrer votre adresse mail :</p>
	<p><form class = "form-horizontal" role="form" method="post"  action="structure.php?page=password">
			<div class="form-group">
				<label class="control-label col-sm-2" for="user">Utilisateur :</label>
				<div class="col-sm-10">
					<input type = "email" name = "user" id = "user" maxlength=64 minlength=4 required>
				</div>
			</div>
			
			
			<div class="form-group"> 
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" name = "send" >Envoyer</button>
				</div>
			</div>
		</form></p>

		<p class = "lead">
			<a href="structure.php?page=password">Pas encore inscrit ?</a>
		</p>


<?php 
	if(isset($_POST['user'])){
		$_char = 'abcdefghijklmnopqrstuvwxyz0123456789/\#().;';
		$_motDePasse = substr(str_shuffle($_char),2,10);
		reinitialisation_password($_POST['user'], $_motDePasse);
	}

		
} else {

	echo '<br/><br/><br/><p class="lead">Vous êtes déjà connecté ! <br/>Vous pouvez revenir à l\'accueil <a href="?page=accueil">ici</a>.</p>';

} ?>
