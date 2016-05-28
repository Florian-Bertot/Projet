<?php 
if (!(isset($_SESSION['site']) and $_SESSION['site'] == 'SHLML')){
 ?>


<br/><br/>
<h1>Connexion</h1>
	<p class="lead">Veuillez entrer vos identifiants de connexion :</p>
	<p><form class = "form-horizontal" role="form" method="post"  action="structure.php?page=connexion">
			<div class="form-group">
				<label class="control-label col-sm-2" for="user">Utilisateur :</label>
				<div class="col-sm-10">
					<input type = "text" name = "user" id = "user" maxlength=64 required>
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
					<button type="submit" name = "connexion" >OK</button>
				</div>
			</div>
		</form></p>
		<p class = "lead">
			Mot de passe oublié ? 
			<a href="structure.php?page=password">Cliquez ici</a>.
		</p>

		<p class = "lead">
			<a href="structure.php?page=inscription">Pas encore inscrit ?</a>
		</p>
		
		<?php
			if (isset($_POST['connexion']) && $_POST['password']!='' && $_POST['user']!='') {
				authentification($_POST['user'],$_POST['password']);
			}
		
		?>

<?php 
} else {

	echo '<br/><br/><br/><p class="lead">Vous êtes déjà connecté ! <br/>Vous pouvez revenir à l\'accueil <a href="?page=accueil">ici</a>.</p>';

} ?>

