<?php 

	if (isset($_SESSION['site']) and $_SESSION['site'] == 'SHLML'){

 ?>

<br/><br/><br/>

  	<h1>Modifier votre adresse mail</h1>
	<br/>
	<p class="lead">
		Merci de bien vouloir remplir les champs suivants :
		<p><form class = "form-horizontal" role="form" method="post"  action="structure.php?page=gestion_compte_id">
					<div class="form-group">
						<label class="control-label col-sm-2" for="old_id">Ancienne adresse mail :</label>
						<div class="col-sm-10">
							<input type = "email" name = "old_id" id = "old_id" maxlength=64 required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="password">Mot de passe :</label>
						<div class="col-sm-10">
							<input type = "password" name = "password" id = "password" maxlength=32 required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="new_id">Nouvelle adresse mail :</label>
						<div class="col-sm-10">
							<input type = "email" name = "new_id" id = "new_id" maxlength=64 required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="new_id_bis">Répéter l'adresse mail : </label>
						<div class="col-sm-10"> 
							<input type="email" name = "new_id_bis" id ="new_id_bis" maxlength=64 required>
						</div>
					</div>
					<div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" name = "gestion_compte_id" >OK</button>
						</div>
					</div>
				</form>
				</p>
	</p>

 <?php 

	 	if (isset($_POST['old_id']) and isset($_POST['password']) and isset($_POST['new_id']) and isset($_POST['new_id_bis']) and isset($_SESSION['Email'])){
	 		if ($_SESSION['Email'] != $_POST['old_id']){
	 			echo '<p class="lead">Veuillez modifier votre propre adresse mail.</p>';
	 		} else {
	 			if (recherche_mail($_POST['new_id'])){
	 				echo '<p class="lead">Cette adresse existe déjà. Veuillez en renseigner une autre.</p>';
	 			} else {
			 		if ($_POST['new_id'] != $_POST['new_id_bis']){
			 			echo '<p class="lead">Veuillez spécifier la même adresse mail dans les deux champs.</p>';
			 		} else {
			 			modification_email($_POST['old_id'], $_POST['password'], $_POST['new_id']);
			 		}
			 	}
	 		}
	 	}

 	} else {
		include('Pages/Connexion.php');
 	}
  ?>