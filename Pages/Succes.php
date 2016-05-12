<?php 
	if (isset($_SESSION['site']) and ($_SESSION['site'] == 'SHLML')) {
	?>

<br/><br/><br/>

  	<h1>Succès</h1>

  	<!-- TODO : Faire la page -->

  	<?php 
	} else {
		include('Pages/Connexion.php');
	}
?>

