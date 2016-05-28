<?php 
	if (isset($_SESSION['site']) and ($_SESSION['site'] == 'SHLML')) {
	?>

<br/><br/><br/>

  	<h1>Succès</h1>

  	<p class="lead"> Bienvenue sur la page d'acceuil des succès ! <br/>
  	Ici, vous pouvez suivre l'évolution de vos succès.
  	</p>


  	//TODO : Faire l'affichage des succès
  	<div class="row">
  		<div class="col-sm-6"><img src= " . $_donnees['Photo'] . " alt=" . $_donnees['Prenom'] ." width='150' height='150'/></div>
  		<div class="col-sm-6"></div>
  	</div>

  	<div class="row">
  		<div class="col-sm-6"></div>
  		<div class="col-sm-6"></div>
  	</div>

  	<div class="row">
  		<div class="col-sm-6"></div>
  		<div class="col-sm-6"></div>
  	</div>

  	<div class="row">
  		<div class="col-sm-6"></div>
  		<div class="col-sm-6"></div>
  	</div>

  	<div class="row">
  		<div class="col-sm-6"></div>
  		<div class="col-sm-6"></div>
  	</div>

  	<div class="row">
  		<div class="col-sm-6"></div>
  		<div class="col-sm-6"></div>
  	</div>

  	<div class="row">
  		<div class="col-sm-6"></div>
  		<div class="col-sm-6"></div>
  	</div>

<?php 
	} else {
		include('Pages/Connexion.php');
	}
?>

