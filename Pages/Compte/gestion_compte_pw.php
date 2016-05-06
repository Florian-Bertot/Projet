<?php 

	if (isset($_SESSION['site']) and $_SESSION['site'] == 'SHLML'){

 ?>

<br/><br/><br/>

<h1>Modifier votre mot de passe</h1>
<br/>
<p class="lead">
	Merci de bien vouloir remplir les champs suivants :
	<p><form class = "form-horizontal" role="form" method="post"  action="structure.php?page=gestion_compte_pw">
				<div class="form-group">
					<label class="control-label col-sm-2" for="old_password">Ancien mot de passe :</label>
					<div class="col-sm-10">
						<input type = "password" name = "old_password" id = "old_password" maxlength=32>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="new_password">Nouveau mot de passe :</label>
					<div class="col-sm-10">
						<input type = "password" name = "new_password" id = "new_password" maxlength=32>
					</div>
				</div>				
				<div class="form-group">
					<label class="control-label col-sm-2" for="new_password_bis">Confirmer le nouveau mot de passe :</label>
					<div class="col-sm-10">
						<input type = "password" name = "new_password_bis" id = "new_password_bis" maxlength=32>
					</div>
				</div>
				<div class="form-group"> 
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name = "gestion_compte_pw" >OK</button>
					</div>
				</div>
			</form>
			</p>
</p>

 <?php 

 	 	if (isset($_POST['old_password']) and isset($_POST['new_password']) and isset($_POST['new_password_bis']) and isset($_SESSION['Email'])){
 	 		//On vérifie qu'il y a un changement de mot de passe
 	 		if ($_POST['old_password'] == $_POST['new_password']){
 	 			echo '<p class="lead">Veuillez spécifier un nouveau mot de passe.</p>';
 	 		} else {
 	 			//On vérifie que le mot de passe fait au moins 6 caractères
			 	if (strlen($_POST['new_password'])<6){
			 		echo '<p class="lead">Veuillez spécifier un mot de passe contenant au moins 6 caractères.</p>';
			 	} else {
			 		//On verifie que les deux mots de passe sont identiques
			 		if ($_POST['new_password'] != $_POST['new_password_bis']){
			 			echo '<p class="lead">Veuillez spécifier le même mot de passe dans les deux champs.</p>';
			 		} else {
			 			//On modifie le mot de passe
			 			modification_password($_SESSION['Email'], $_POST['old_password'], $_POST['new_password']);
			 		}
			 	}
			}	
	 	}

 	} else {
		include('Pages/Connexion.php');
 	}
  ?>