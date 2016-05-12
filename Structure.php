<?php
	session_start();
?>

<! DOCTYPE HTML>

<html>
	<head>
		<meta charset="utf-8-bin">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Société Histoire de la Lorraine et du Musée Lorrain</title>
		
		<link rel="icon" type="ico" href="favicon.ico" />
		<?php
			include('fonction.php');
			include('contenu.php');
		?>
		<link href="css/bootstrap.css" rel="stylesheet" >
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		
		<!-- 1. Link to jQuery (1.8 or later), -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> <!-- 33 KB -->

		<!-- fotorama.css & fotorama.js. -->
		<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->
		
		<script src="js/bootstrap.min.js"></script>
		
	</head>
	
	<body>
	
		<div class="navbar navbar-inverse navbar-fixed-top"><!-- Menu collé en haut de la fenêtre. Il suit le défilement -->
			<div class="container">
			
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="http://www.societe-histoire-lorraine.com/"><font color="white"><b>SOCIÉTÉ D'HISTOIRE<br/>DE LA LORRAINE ET<br/>DU MUSÉE LORRAIN</b></font></a>
				</div><!-- /.navbar-header -->
				
				<!-- Onglets -->
				
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="?page=accueil"><b>Accueil</b></a></li>
						<li><a href="?page=transcription"><b>Transcription</b></a></li>

					</ul>
					<ul class="nav navbar-nav navbar-right">
						
						<?php
						if (isset($_SESSION['site']) && $_SESSION['site']=='SHLML'){
							if (check_admin($_SESSION['Email'])){echo '<li><a href="?page=admin"><b>Administration</b></a></li>';}
							echo '<li><a href="?page=contact"><b>Contact</b></a></li>';							
							echo '<li class="dropdown">
					              <a href="?page=compte" class="dropdown-toggle" data-toggle="dropdown"><b>Compte</b><b class="caret"></b></a>
					              <ul class="dropdown-menu">
					                <li><a href="?page=compte"><b>Accéder à ses informations</b></a></li>
					                <li><a href="?page=gestion_compte_id"><b>Modifier son adresse mail</b></a></li>
					                <li><a href="?page=gestion_compte_pw"><b>Modifier son mot de passe</b></a></li>
					                <li><a href="?page=gestion_pic"><b>Modifier sa photo de profil</b></a></li>
					                <li><a href="?page=succes"><b>Afficher les succès</b></a></li>
					              </ul>
					            </li>';

							echo '<li><a href="?page=deconnexion"><b>Déconnexion</b></a></li>';


						} else{
							echo '<li><a href="?page=contact"><b>Contact</b></a></li>
							<li><a href="?page=inscription"><b>Inscription</b></a></li>
							<li><a href="?page=connexion"><b>Connexion</b></a></li>';
						}
						?>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	
	
    <div class="container wrapper">
		<div class="template">
			<div class="row">
				<div class="col-xm-10">
				
				<?php
					//On utilise une requête en php GET pour modifier l'intérieur de cette page, ainsi tout le template est facilement modifiable.
					if (isset($_GET['page'])){
						contenu($_GET['page']);
					} else {
						contenu('accueil');
					}
				?>
					
				</div> <!-- /.col-xm -->
			</div> <!-- /.row -->
		</div> <!-- /.template -->
			
			
		<div class="push"></div>
	</div> <!-- /.container -->
	<!-- Bas de page -->
			
			<div class="row">
				<div class="footer">
				
					<div class="row partie1" >
						<div class="col-sm-4">
							<center><a href="https://musee-lorrain.nancy.fr/fr"><img src="banqueImage/logo_musee-lorrain.jpg"></a><br/><br/>Accueil de nos collections</center>
						</div> <!-- /.col -->
						<div class="col-sm-4">
							<center><a href="http://www1.nancy.fr/portail/"><img src="banqueImage/logo_ville_Nancy.png"></a><br/><br/>Notre soutien sans faille depuis 1848</center>
						</div> <!-- /.col -->
						<div class="col-sm-4">
							<center><a href="http://www.lorraine.eu/accueil.html"><img src="banqueImage/logo_region_Lorraine.jpg"></a></center>
						</div> <!-- /.col -->
					</div> <!-- /.row -->
					
					<div class="row partie2">
						<div class="col-sm-12">
							<center><p class="lead">64 Grande rue, Nancy, Lorraine, 54000, France</p></center>
						</div> <!-- /.col -->
					</div> <!-- /.row -->	
					
				</div> <!-- /.footer -->
			</div> <!-- /.row -->
			
			<!-- Fin bas de page -->
	
	</body>

</html>