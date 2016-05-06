<br/>
<br/>
<h1>Accueil</h1>
<?php 

if (isset($_SESSION['site']) and $_SESSION['site']=='SHLML'){
	echo '
	<p class="lead">

	Bienvenue sur le site de la société Histoire de la Lorraine !<br \>
	Merci de vous être connecté. Vous pouvez commencer les transcriptions <a href="Structure.php?page=transcription">ici</a>

	</p>';

} else {
	echo '
	<p class="lead">

	Bienvenue sur le site de la société Histoire de la Lorraine !<br \>
	Afin de pouvoir effectuer des transcription, veuillez vous identifier <a href="Structure.php?page=connexion">ici</a>

	</p>';
}
?>
