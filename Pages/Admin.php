<?php 
	if (isset($_SESSION['site']) and $_SESSION['site'] == 'SHLML'){
		if (check_admin($_SESSION['Email'])){
			echo '<br/><br/><br/><h1>Bienvenue sur le panneau d\'administration</h1>';
		} else {
			header('Location: Structure.php?page=accueil');
		}
	} else {
		include('Pages/Connexion.php');
	}
 ?>