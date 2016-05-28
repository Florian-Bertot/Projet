<?php 
	if (isset($_SESSION['site']) and ($_SESSION['site'] == 'SHLML')){
		if (check_admin($_SESSION['Email'])){
?>

		<br/><br/><br/><h1>Bienvenue sur la page de transcription !</h1>

		<p class="lead">
			Si vous souhaitez accéder à une fiche en particulier, veuillez renseigner les informations ci-dessous.<br/>
			En l'absence d'informations, vous accéderez à votre dernière fiche transcrite
		</p>








<?php
		} else {
			header('Location: Structure.php?page=accueil');
		}
	} else {
		include('Pages/Connexion.php');
	}
?>