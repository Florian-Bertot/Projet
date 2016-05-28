<?php

if (isset($_SESSION['site']) and $_SESSION['site']=='SHLML'){
	echo '<br/><br/><h1>Deconnexion</h1>
	<p class="lead">
	Vous n\'êtes plus connecté.<br/>
	Vous pouvez revenir à l\'accueil <a href="Structure.php?page=accueil">ici</a></p>.';
	session_destroy();
	header('Location: Structure.php?page=accueil');

} else {
	echo '<br/><br/><h1>Deconnexion</h1>
	<p class="lead">
	Vous devez être connecté pour accéder à cette page.<br/>
	Vous pouvez vous connecter <a href="Structure.php?page=connexion">ici</a></p>';
}

?>