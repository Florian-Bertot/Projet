<?php 
	if (isset($_SESSION['site']) and ($_SESSION['site'] == 'SHLML')) {
	?>
		<br/><br/>
		<h1>Bienvenue sur la page de transcription</h1>

		<p class='lead'>Voici une note de bibliothèque. Veuillez transcrire dans les champs prévus à cet effet les informations notées. <br/>
		S'il s'agit de votre première transcription, veuillez lire les règles <a href="Structure.php?page=regles">ici</a>.<br/><br/><br/>
		</p>

		<div class="row">

			<div class="col-sm-7">
				<?php 	load_image($_SESSION['Email']);?>
			</div>





			<div class="col-sm-5">

				<p><form class = "form-horizontal" role="form" method="post"  action="structure.php?page=transcription">
				<div class="form-group">
					<label class="control-label col-sm-4" for="cote1">Première ligne de Côte :</label>
					<div class="col-sm-10">
						<input type = "text" name = "cote1" id = "cote1" maxlength=100>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="cote2">Deuxième ligne de Côte :</label>
					<div class="col-sm-10">
						<input type = "text" name = "cote2" id = "cote2" maxlength=100>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="cote3">Troisième ligne de Côte :</label>
					<div class="col-sm-10">
						<input type = "text" name = "cote3" id = "cote3" maxlength=100>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="auteurs">Auteurs :</label>
					<div class="col-sm-10">
						<input type = "text" name = "auteurs" id = "auteurs" maxlength=500>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="titre">Titre :</label>
					<div class="col-sm-10">
						<input type = "text" name = "titre" id = "titre" maxlength=500>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="lieu">Lieu :</label>
					<div class="col-sm-10"> 
						<input type="text" name = "lieu" id ="lieu" maxlength=500>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="format">Format :</label>
					<div class="col-sm-10"> 
					<input type="textarea" name = "format" id ="format" maxlength=500>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="comments">Commentaires :</label>
					<div class="col-sm-10"> 
					<input type="textarea" name = "comments" id ="comments" maxlength=200>
					</div>
				</div>
				<div class="form-group"> 
					<div class="col-sm-offset-2 col-sm-10">
  						<button type="reset" value= "Reset">Reset</button>
						<button type="submit" name = "Transcription" >OK</button>
					</div>
				</div>
			</form>
			</p>
			<br/><br/><br/>
			</div>
		</div>

	<?php	
		if (!isset($_POST['cote1']) or !isset($_POST['cote2']) or !isset($_POST['cote3']) or !isset($_POST['auteurs']) or !isset($_POST['titre']) or !isset($_POST['lieu']) or !isset($_POST['comments']) or !isset($_POST['format'])){
			echo '';
		} else {
				if (transcription($_SESSION['Email'], $_POST['cote1'], $_POST['cote2'], $_POST['cote3'], $_POST['auteurs'], $_POST['titre'], $_POST['lieu'], $_POST['comments'], $_POST['format'])){
					next_image($_SESSION['Email']);
				}
		}

	} else {
		include('Pages/Connexion.php');
	}
 ?>

