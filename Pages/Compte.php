<?php 
	if (isset($_SESSION['site']) and ($_SESSION['site'] == 'SHLML')) {
	?>

<br/><br/><br/>

  	<h1>Informations de compte</h1>

  	<?php informations_compte($_SESSION['Email']); 
	} else {
		include('Pages/Connexion.php');
	}
?>

