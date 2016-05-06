<?php 

	if (isset($_SESSION['site']) and $_SESSION['site'] == 'SHLML'){
		upload_profil($_SESSION['Email'], "mon_fichier", "banqueImage/Avatars/", 1048576, array("jpg", "jpeg", "JPG", "JPEG"));
 	} else {
		include('Pages/Connexion.php');
 	}
  ?>