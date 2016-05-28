<?php

function contenu($_page) {
	//cette fonction gère tout le contenu de la page principale. Elle redirige vers les pages demandées par $_page.
	if ($_page=='accueil'){
		include("Pages/Accueil.php");

	} elseif ($_page=='transcription') {
		include("Pages/Transcription.php");
				
	} elseif ($_page=='connexion') {			
		include("Pages/Connexion.php");		
				
	} elseif ($_page=='contact'){
		header('Location: http://www.societe-histoire-lorraine.com/contact/');
	
	} elseif ($_page=='inscription'){
		include("Pages/Inscription.php");

	} elseif ($_page=='deconnexion') {
		include("Pages/Deconnexion.php");

	} elseif ($_page=='compte'){
		include("Pages/Compte.php");

	} elseif ($_page=='gestion_compte_id'){
		include("Pages/Compte/gestion_compte_id.php");

	} elseif ($_page=='gestion_compte_pw'){
		include("Pages/Compte/gestion_compte_pw.php");

	} elseif ($_page=='gestion_compte'){
		include("Pages/Compte/gestion_compte.php");

	} elseif ($_page=='regles'){
		include("Pages/Regles.php");

	} elseif ($_page=='gestion_pic'){
		include("Pages/Compte/gestion_pic.php");

	} elseif ($_page=='admin'){
		include("Pages/Admin/Admin.php");

	} elseif ($_page=='password'){
		include("Pages/Password.php");

	} elseif ($_page=='succes'){
		include("Pages/Succes.php");

	} elseif ($_page=='transcription_admin'){
		include("Pages/Admin/Transcription_Admin.php");

	} else {
		echo '<br/><h1>Désolé,</h1><p class="lead">Nous ne trouvons pas la page demandée.<br/> <a href="structure.php?page=accueil">Retour à l\'acceuil</a></p>';
	}
}
?>