<?php 
	if (isset($_SESSION['site']) and ($_SESSION['site'] == 'SHLML')) {
	?>

<br/><br/><br/>

	<h1>Règles de transcription</h1>

	<h2>Premier exemple</h2>

	<p class="lead">
		Bienvenue dans ce petit entrainement à la transcription.<br/>
		Pour commencer, voici un petit exemple de ce à quoi ressemble votre fenêtre :<br/><br/>

		<!-- TODO : Insérer screenshot de la fenêtre -->
		<img src="banqueImage/fenetre.jpg" alt="Voici une fenêtre !"><br/><br/>

		Comme vous pouvez le voir, l'écran est divisé en deux parties :<br/>

		A gauche, vous voyez le recto puis le verso d'une fiche de bibliothèque.<br/>
		A droite, vous voyez plusieurs champs à remplir.<br/>
		Vous devez remplir les champs afin de reproduire le plus fidèlement possible ce qui est écrit !<br/><br/>

		<!-- TODO : Insérer screenshot de la fenêtre complétée -->
		<img src="banqueImage/fenetre.jpg" alt="Et la fenêtre remplie correspondante !"><br/><br/>

		Votre objectif : Réussir à effectuer les transcriptions pour gagner des points !
	</p>


	<h2>Quelques conventions d'écriture</h2><br/>

	<p class="lead">
		Afin de pouvoir obtenir un contenu correct, voici quelques conventions pour transcrire les fiches :<br/>
		<ul>
			<li><p class="lead">Tout les champs doivent être remplis </p></li>
			<li><p class="lead">Pas de caractères accentués (é, è ...) </p></li>
			<li><p class="lead">Les caractères spéciaux (tels que ° ...) seront représentés par un espace </p></li>
			<li><p class="lead">Les majuscules n'ont pas d'importance</p></li>
			<li><p class="lead">Si un champ est illisible ou n'existe pas, le remplir avec un °</p></li>
			<li><p class="lead">Si il y a plusieurs auteurs, les séparer par un ; </p></li>

		</ul></p>

	<h2>Attribution des points</h2><br/>

	<p class="lead">
		Les règles d'attribution des points sont simple :<br/>
		<ul>
			<li><p class="lead">Lorsque suffisament de bonne transcriptions ont été effctuées, chaque joueur l'ayant réalisé se voit accorder 1 point</p></li>
			<li><p class="lead">Le premier joueur à valider la transcription d'une fiche se voit accorder 1 point supplémentaire</p></li>
		</ul>


	</p>





		<br/><br/>

	

  	
  	<?php
  	/*fiches('$',364);
  	fiches('A',825);
  	fiches('B',2778);
  	fiches('C',2904);
  	fiches('D',1689);
  	fiches('E',368);
  	fiches('F',874);
  	fiches('G',1836);
  	fiches('H',910);
  	fiches('I',215);
  	fiches('J',602);
  	fiches('K',243);
  	fiches('L',1996);
  	fiches('M',2220);
  	fiches('N',468);
  	fiches('O',245);
  	fiches('P',1452);
  	fiches('Q',85);
  	fiches('R',2192);
  	fiches('S',1377);
  	fiches('T',708);
  	fiches('U',55);
  	fiches('V',713);
  	fiches('w', 271);
  	fiches('x', 10);
  	fiches('y', 11);
  	fiches('z', 45);*/
	} else {
		include('Pages/Connexion.php');
	}
?>