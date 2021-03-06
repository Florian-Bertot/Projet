<?php 

	function requete_bdd(){

		if ($_bdd = mysqli_connect('localhost','root','','seriousgame')){
			mysqli_query($_bdd, 'SET NAMES UTF8');
			return $_bdd;
		} else {
			echo 'Erreur de connection a la base de donnees';
		}
	}

	function authentification($_user,$_password){
		 $_bdd = requete_bdd();
		 $_sql = "SELECT * FROM membres WHERE Email = '" . $_user . "'";
		 $_resultat = mysqli_query($_bdd, $_sql);
		 $_error = 'Utilisateur inconnu';

		while ($_donnees = mysqli_fetch_assoc($_resultat)){
			
			if ($_donnees['Password'] == $_password){
				$_SESSION['Nom'] = $_donnees['Nom'];
				$_SESSION['Prenom'] = $_donnees['Prenom'];
				$_SESSION['Email'] = $_donnees['Email'];
				$_SESSION['site'] = 'SHLML';
				$_error = 'Connexion reussie';
				give_succes_connection($_donnees['ID_Membre'], $_donnees['Last_Connection']);
				$_sql_ul = "UPDATE membres SET Last_Connection = now() WHERE Email = '".$_user."'";
				mysqli_query($_bdd, $_sql_ul);
				mysqli_close($_bdd);
			} else {
				$_error = 'Mot de passe incorrect';
			}
		}
		mysqli_free_result($_resultat);
		echo $_error;
		header('Location: Structure.php?page=accueil');
	}

	function inscription($_nom, $_prenom, $_email, $_password){
		$_bdd = requete_bdd();
		$_sql = "INSERT INTO membres(Nom, Prenom, Email, Password) VALUES ('" . $_nom . "','" . $_prenom . "','" . $_email . "','" . $_password . "')";
		mysqli_query($_bdd,$_sql);						
		mysqli_close($_bdd);
		echo '<p class="lead"> L\'inscription a reussie !<br/>
		Votre compte à bien été créé</p>';
	}

	function inscription_succes($_user){
		$_bdd = requete_bdd();
		$_sql_dl = "SELECT ID_Membre FROM membres WHERE Email = '".$_user."'";
		$_resultat = mysqli_query($_bdd, $_sql_dl);
		$_donnees = mysqli_fetch_assoc($_resultat);
		$_sql_ul = "INSERT INTO succes SET ID_Membre = ".$_donnees['ID_Membre'];
		mysqli_query($_bdd, $_sql_ul);
		mysqli_close($_bdd);
	}

	function recherche_mail($_email){
		$_bdd = requete_bdd();
		$_sql = "SELECT * FROM membres WHERE Email = '" . $_email . "'";
		$_resultat = mysqli_query($_bdd, $_sql);
		$_lignes = mysqli_num_rows($_resultat);
		if ($_lignes == 0){
			return false;
		}
		 return true;
	}

	function modification_email($_user,$_password,$_newUser){
		$_bdd = requete_bdd();
		//Requête pour vérifier le mot de passe
		$_sql_pw = "SELECT Password FROM membres WHERE Email = '" . $_user . "'";
		$_resultat = mysqli_query($_bdd,$_sql_pw);
		$_donnees = mysqli_fetch_assoc($_resultat);
		if ($_donnees['Password'] == $_password){
			//Requete de modification de la base
			$_sql = "UPDATE membres SET Email = '" . $_newUser . "' WHERE Email = '" . $_user . "'";
			mysqli_query($_bdd, $_sql);
			mysqli_close($_bdd);
			echo '<p class="lead"> Votre Email a bien été modifié !<br/>
			<a href="Structure.php?page=connexion">Veuillez vous reconnecter ici</a></p>.';
			session_destroy();
		} else {
			echo '<p class="lead"> Mot de passe incorect !<br/> Veuillez reessayer.</p>';
		}
	}

	function modification_password($_user,$_oldPassword,$_newPassword){
		$_bdd = requete_bdd();
		//Requête pour vérifier le mot de passe
		$_sql_pw = "SELECT Password FROM membres WHERE Email = '" . $_user . "'";
		$_resultat = mysqli_query($_bdd,$_sql_pw);
		$_donnees = mysqli_fetch_assoc($_resultat);
		if ($_donnees['Password'] == $_oldPassword){
			//Requete de modification de la base
			$_sql = "UPDATE membres SET Password = '" . $_newPassword . "' WHERE Email = '" . $_user . "'";
			mysqli_query($_bdd, $_sql);
			mysqli_close($_bdd);
			echo '<p class="lead"> Votre mot de passe a bien été modifié !<br/>
			<a href="Structure.php?page=connexion">Veuillez vous reconnecter ici</a></p>.';
			session_destroy();
		} else {
			echo '<p class="lead"> Mot de passe incorect !<br/> Veuillez reessayer.</p>';
		}
	}

	function reinitialisation_password($_user, $_password){
		$_mail = 	"Bonjour, \r\n
					\r\n
				   	Vous recevez ce mail suite à votre demande de réinitialisation \r\n
				   	de mot de passe. \r\n
				   	\r\n
				   	Votre nouveau mot de passe est : ".$_password." \r\n
				   	Veuillez vous rendre sur le site afin de modifier votre mot de passe. \r\n
				   	\r\n
				   	Bien cordialement \r\n
				   	L'équipe SHLML\r\n
				   	\r\n
				   	__________________________________________\r\n
				   	\r\n
				   	Ce mail a été envoyé automatiquement depuis\r\n
				   	l'adresse webmaster@shlml.com. Cette adresse n'est pas \r\n
				   	utilisée à des fins de contact. \r\n
				   	Si vous souhaitez nous contacter, veuillez utiliser \r\n
				   	la section contact du site. \r\n
				   	";
		$_header = "'From : webmaster@shlml.com'";
		$_title = "Reinitialisation de votre mot de passe";
		if (mail($_user, $_title, $_mail, $_header)){
			/*$_bdd = requete_bdd();
			$_sql = "UPDATE membres SET Password = '" .$_password. "' WHERE Email = '" .$_user. "'";
			mysqli_query($_bdd, $_sql);
			mysqli_close($_bdd);
			echo 'Votre mot de passe à été envoyé à l\'adresse suivante : '.$_POST["user"].'<br/>';*/
		} else {
			echo 'Echec de la réinitialisation. Veuillez réessayer.';
		}
	}

	function informations_compte($_user){
		$_bdd = requete_bdd();
		$_sql = "SELECT * FROM membres WHERE Email = '" . $_user . "'";
		$_resultat = mysqli_query($_bdd,$_sql);
		$_donnees = mysqli_fetch_assoc($_resultat);
		$_points = $_donnees['Trans_Valid'] + $_donnees['Point_Premier'];

		echo "	<p class='lead'>
			Bienvenue ! Voici les informations relatives à votre compte : <br/><br/>
			Nom : " . $_donnees['Nom'] . "<br/>
			Prenom : " . $_donnees['Prenom'] . "<br/>
			Nombre de transcriptions effectuées : " . $_donnees['Trans_Done'] . "<br/>
			Nombre de points : " . $_points . "<br/>
			Photo de profil : <img src= " . $_donnees['Photo'] . " alt=" . $_donnees['Prenom'] ." width='150' height='150'/>

	</p>";
	}


	function upload_profil($_user, $_index, $_destination, $_maxSize, $_extension){
		$_bdd = requete_bdd();
		$_sql = "SELECT ID_Membre, Photo FROM membres WHERE Email = '" . $_user . "'";
		$_resultat = mysqli_query($_bdd, $_sql);
		$_donnees = mysqli_fetch_assoc($_resultat);

		echo "<br/><br/><br/>

		<h1>Modifier votre photo de profil</h1>

		<p class='lead'>Votre photo de profil actuelle est : <img src=" . $_donnees['Photo'] . " alt = 'Votre photo !' width='150' height='150' /><br/>
				<p><form method='post' action='?page=gestion_pic' enctype='multipart/form-data'>
				     <label for='mon_fichier'><p class='lead'>Veuillez choisir votre nouvelle photo de profil (Format .jpg | max. 1 Mo) :</p></label><br />
				     <input type='hidden' name='MAX_FILE_SIZE' value='1048576' />
				     <input type='file' name='mon_fichier' id='mon_fichier' /><br />
				     <input type='submit' name='submit' value='Envoyer' />
				</form>
				</p>
			</p>";

		//On teste si le fichier a été uploadé
		if (!isset($_FILES[$_index]) OR $_FILES[$_index]['error'] > 0){
			echo '';
		} else 
			//On teste si le fichier n'est pas trop lourd
			if ($_FILES[$_index]['size'] > $_maxSize){
				echo 'Le fichier selectionné est trop lourd. Veuillez sélectionner une image de moins d\'1 Mo.';
			} else {
				//On teste si le fichier à la bonne extension
				$_ext = substr(strrchr($_FILES[$_index]['name'],'.'),1);
				if (!in_array($_ext, $_extension)){
					echo 'Veuillez selectionner une image au format jpeg';
				} else {
					//On teste si le fichier est déplacable avec le bon nom
					if (move_uploaded_file($_FILES[$_index]['tmp_name'],"banqueImage/Avatars/photo_". $_donnees['Identifiant'] .".jpg")){
						//Si le fichier est déplacé, on change la bdd
						$_sql_pic = "UPDATE membres SET Photo = '" . $_destination . "photo_". $_donnees['Identifiant'] .".jpg' WHERE Email = '" . $_user . "'";
						mysqli_query($_bdd,$_sql_pic);
						mysqli_close($_bdd);
						clearstatcache();
						header('Location: Structure.php?page=compte');
					}
				}
			}
		}

	function load_image($_user){
		$_bdd = requete_bdd();
		$_sql_dl = "SELECT Trans_Lettre, Trans_Nombre FROM membres WHERE Email = '" . $_user . "'";
		$_resultat = mysqli_query($_bdd, $_sql_dl);
		$_donnees = mysqli_fetch_assoc($_resultat);

		$_lettre = $_donnees['Trans_Lettre'];
		$_nombre = $_donnees['Trans_Nombre'];
		$_milliers = floor($_nombre/1000);
		$_nombre = $_nombre%1000;
		$_centaines = floor($_nombre/100);
		$_nombre = $_nombre%100;
		$_dizaines = floor($_nombre/10);
		$_nombre = $_nombre%10;
		$_unités = $_nombre;

		echo '<img src="banqueImage/Fiches/R-cat-'. $_lettre .'/R_'. $_lettre .'-'. $_milliers .''. $_centaines .''. $_dizaines .''. $_unités .'.jpg" width="600" height="600">';

	}

	function next_image($_user){
		//Requete pour obtenir les informations sur la dernière fiche transcrite
		$_bdd = requete_bdd();
		$_sql_dl = "SELECT Trans_Lettre, Trans_Nombre, Admin FROM membres WHERE Email = '" . $_user . "'";
		$_resultat = mysqli_query($_bdd, $_sql_dl);
		$_donnees = mysqli_fetch_assoc($_resultat);

		//Modification des données pour accéder au fichier
		$_lettre = $_donnees['Trans_Lettre'];
		$_nombre = $_donnees['Trans_Nombre']+1;
		$_milliers = floor($_nombre/1000);
		$_nombre = $_nombre%1000;
		$_centaines = floor($_nombre/100);
		$_nombre = $_nombre%100;
		$_dizaines = floor($_nombre/10);
		$_nombre = $_nombre%10;
		$_unités = $_nombre;
		clearstatcache();

		if ($_lettre == '$'){
			if (file_exists('banqueImage/Fiches/R-cat-'. $_lettre .'/R_'. $_lettre .'-'. $_milliers .''. $_centaines .''. $_dizaines .''. $_unités .'.jpg')) {
				$_sql_ul = "UPDATE membres SET Trans_Nombre = Trans_Nombre +1 WHERE Email = '". $_user ."'";
				mysqli_query($_bdd,$_sql_ul);
				mysqli_close($_bdd);				
			} else {
				$_sql_ul = "UPDATE membres SET Trans_Lettre = 'A', Trans_Nombre = '1' WHERE Email = '". $_user ."'";
				mysqli_query($_bdd,$_sql_ul);
				mysqli_close($_bdd);	
			}

		} else {
			//Si le fichier existe, on incrément le numero de la fiche
			if (file_exists('banqueImage/Fiches/R-cat-'. $_lettre .'/R_'. $_lettre .'-'. $_milliers .''. $_centaines .''. $_dizaines .''. $_unités .'.jpg')){
				$_sql_ul = "UPDATE membres SET Trans_Nombre = Trans_Nombre +1 WHERE Email = '". $_user ."'";
				mysqli_query($_bdd,$_sql_ul);
				mysqli_close($_bdd);			
			} else {
				//Si le fichier n'existe pas, on change de dossier et on remet le numero de fiche à 1
				$_lettre = chr(ord($_lettre)+1);
				$_sql_ul = "UPDATE membres SET Trans_Lettre = '" . $_lettre . "', Trans_Nombre = '1' WHERE Email = '". $_user ."'";
				mysqli_query($_bdd,$_sql_ul);
				mysqli_close($_bdd);	
			}
		}	
	echo '<meta http-equiv="refresh" content="0;URL=Structure.php?page=transcription">';

	}

	function transcription($_user, $_c1, $_c2, $_c3, $_auteurs, $_titre, $_lieu, $_comments, $_format){
		$_bdd = requete_bdd();
		$_sql_dl_m = "SELECT ID_Membre, Trans_Lettre, Trans_Nombre, Admin FROM membres WHERE Email = '". $_user ."'";
		$_resultat_m = mysqli_query($_bdd, $_sql_dl_m);
		$_donnees_m = mysqli_fetch_assoc($_resultat_m);

		//On récupère les informations sur la fiche
		$_lettre = $_donnees_m['Trans_Lettre'];
		$_nombre = $_donnees_m['Trans_Nombre'];
		$_milliers = floor($_nombre/1000);
		$_nombre = $_nombre%1000;
		$_centaines = floor($_nombre/100);
		$_nombre = $_nombre%100;
		$_dizaines = floor($_nombre/10);
		$_nombre = $_nombre%10;
		$_unités = $_nombre;
		$_done = false;

		//On enlève les accents
		$_accents = Array("/é/", "/è/", "/ê/","/ë/", "/ç/", "/à/", "/â/","/á/","/ä/","/ã/","/å/", "/î/", "/ï/", "/í/", "/ì/", "/ù/", "/ô/", "/ò/", "/ó/", "/ö/");
    	$_sans = Array("e", "e", "e", "e", "c", "a", "a","a", "a","a", "a", "i", "i", "i", "i", "u", "o", "o", "o", "o");

    	//On enlève les espaces
    	$_espaces = Array("/, /", "/ ,/", "/ , /", "/; /", "/ ;/", "/ ; /", "/( /", "/ (/", "/ ( /", "/) /", "/ )/", "/ ) /", "/ ./", "/. /", "/ . /", "/\[ /", "/ \[/", "/ \[ /", "/ ]/", "/] /", "/ ] /");
    	$_sans_espaces = Array(",", ",", ",", ";", ";", ";", ".", "(", "(", "(", ")", ")", ")", ".", ".", ".", "[", "[", "[", "]", "]", "]");
    	
    	//On ne garde que les caractères voulus
		$_regex_usual = "#[a-zA-Z0-9 ()[\]-]+#";
		$_regex_auteur = "#[a-zA-Z0-9 ;()[\]-]+#";


		//On vérifie que l'on a que les caractères voulus
		if (!(preg_match($_regex_usual, $_c1) or preg_match($_regex_usual, $_c2) or preg_match($_regex_usual, $_c3) or	preg_match($_regex_auteur, $_auteurs) or preg_match($_regex_usual, $_titre) or preg_match($_regex_usual, $_lieu) or preg_match($_regex_usual, $_comments) or preg_match($_regex_usual, $_format))){
			echo '<p class="lead">Veuillez écrire les champs selon les règles énumérées <a href="Structure.php?page=regles">ici</a></p><br/><br/>';
		} else {
			//Retrait des accents et espaces
			/*
			$_c1 = preg_replace($_accents,$_sans,$_c1);
			$_c2 = preg_replace($_accents,$_sans,$_c2);
			$_c3 = preg_replace($_accents,$_sans,$_c3);
			$_auteurs = preg_replace($_accents,$_sans,$_auteurs);
			$_titre = preg_replace($_accents,$_sans,$_titre);
			$_lieu = preg_replace($_accents,$_sans,$_lieu);
			$_comments = preg_replace($_accents,$_sans,$_comments);
			$_format = preg_replace($_accents,$_sans,$_format);
			*/

			//On récupère l'ID du document
			$_sql_dl_d = "SELECT ID_Document, C2_Rep FROM documents WHERE Chemin = 'banqueImage/Fiches/R-cat-". $_lettre ."/R_". $_lettre ."-". $_milliers ."". $_centaines ."". $_dizaines ."". $_unités .".jpg'";
			$_resultat_d = mysqli_query($_bdd, $_sql_dl_d);
			$_donnees_d = mysqli_fetch_assoc($_resultat_d);

			//On avance le pointeur du document chez l'user
			$_sql_ul_t ="UPDATE membres SET Trans_Done = Trans_Done+1 WHERE Email = '" . $_user . "'";
			mysqli_query($_bdd, $_sql_ul_t);

			if ($_donnees_m['Admin']){
				if ($_donnees_d['C2_Rep'] == ''){
					//On insère la solution dans la base de donnée des documents
					$_sql_ul = "UPDATE documents SET C1_Rep = '" .$_c1."', C2_Rep = '" .$_c2."', C3_Rep = '" .$_c3."', Titre_Rep = '" .$_titre."', Auteurs_Rep = '" .$_auteurs."', Lieu_Rep = '" .$_lieu."', Comments_Rep = '" .$_comments."', Format_Rep = '" .$_format."' WHERE ID_Document = '".$_idDocument."'";
					mysqli_query($_bdd, $_sql_ul);
					mysqli_close($_bdd);
					give_point_admin($_donnees_d['ID_Document'],$_c1, $_c2, $_c3, $_auteurs, $_titre, $_lieu, $_comments, $_format);
				}
			} else {
				//On insère les résultats dans la base de données pour le membre
				if ($_c1 == '?' or $_c2 == '?' or $_c3 == '?' or $_titre == '?' or $_auteurs == '?' or $_lieu == '?' or $_comments == '?' or $_format == '?'){
					$_sql_ul = "INSERT INTO results(ID_Membre, ID_Document,Trans_Illisible, Cote1, Cote2, Cote3, Auteurs, Titre, Lieu, Commentaires, Format) VALUES ('" . $_donnees_m['ID_Membre'] . "','" . $_donnees_d['ID_Document'] . "',1,'" . $_c1 . "','" . $_c2 . "','" . $_c3 . "','" . $_auteurs . "','" . $_titre . "','" . $_lieu . "','" . $_comments . "','" . $_format . "')";
				} else {
					$_sql_ul = "INSERT INTO results(ID_Membre, ID_Document, Cote1, Cote2, Cote3, Auteurs, Titre, Lieu, Commentaires, Format) VALUES ('" . $_donnees_m['ID_Membre'] . "','" . $_donnees_d['ID_Document'] . "','" . $_c1 . "','" . $_c2 . "','" . $_c3 . "','" . $_auteurs . "','" . $_titre . "','" . $_lieu . "','" . $_comments . "','" . $_format . "')";
				}
				mysqli_query($_bdd, $_sql_ul);
				mysqli_close($_bdd);
				give_point($_donnees_m['ID_Membre'], $_donnees_d['ID_Document'], $_c1, $_c2, $_c3, $_auteurs, $_titre, $_lieu, $_comments, $_format);

			}
			//On attribue les points de succès
			give_succes($_user);
			$_done = true;
		}

		//On renvoie si la transcription a eue lieue ou non
		return $_done;
	}

	function check_admin($_user){
		$_bdd = requete_bdd();
		$_sql = "SELECT Admin FROM membres WHERE Email = '" . $_user . "'";
		$_resultat = mysqli_query($_bdd, $_sql);
		$_donnees = mysqli_fetch_assoc($_resultat);

		return $_donnees['Admin'];
	}


	function give_point($_idMembre, $_idDocument, $_c1, $_c2, $_c3, $_auteurs, $_titre, $_lieu, $_comments, $_format){
		$_bdd = requete_bdd();

		//On récupère les réponses au document demandé
		$_sql_dl_d = "SELECT C1_Rep, C2_Rep, C3_Rep, Titre_Rep, Auteurs_Rep, Lieu_Rep, Comments_Rep, Format_Rep FROM documents WHERE ID_Document = " . $_idDocument;
		$_resultat_d = mysqli_query($_bdd, $_sql_dl_d);
		$_donnees_d = mysqli_fetch_assoc($_resultat_d);
		//Si elle existe
		if ($_donnees_d['C2_Rep'] != "''"){
			//Si la transcription est conforme
			if ($_donnees_d['C1_Rep'] == $_c1 and $_donnees_d['C2_Rep'] == $_c2 and $_donnees_d['C3_Rep'] == $_c3 and $_donnees_d['Titre_Rep'] == $_titre and $_donnees_d['Auteurs_Rep'] == $_auteurs and $_donnees_d['Lieu_Rep'] == $_lieu and $_donnees_d['Comments_Rep'] == $_comments and $_donnees_d['Format_Rep'] == $_format){
				//On augmente les points
				$_sql_ul_m = "UPDATE membres SET Trans_Valid = Trans_Valid+1 WHERE ID_Membre = " . $_idMembre;
			} else {
				//Sinon, on augmente les erreurs
				$_sql_ul_m = "UPDATE results SET Trans_Echec = 1 WHERE ID_Document = ". $_idDocument ." and ID_Membre = " . $_idMembre;
			}
			mysqli_query($_bdd, $_sql_ul_m);
			mysqli_close($_bdd);
		} else {
			//Si elle n'existe pas, on va chercher s'il y en a deux autres identiques
			$_sql_dl_r = "SELECT ID_Membre, Trans_Date, Cote1, Cote2, Cote3, Titre, Auteurs, Lieu, Commentaires, Format FROM results WHERE ID_Document = " . $_idDocument;
			$_resultat_r = mysqli_query($_bdd, $_sql_dl_r);
			$_idUser2 = 0;
			$_timeStamp2 = time();
			$_idUser3 = 0;
			$_timeStamp3 = time();
			while ($_donnees_r = mysqli_fetch_assoc($_resultat_r)){
				if ($_donnees_r['Cote1'] == $_c1 and $_donnees_r['Cote2'] == $_c2 and $_donnees_r['Cote3'] == $_c3 and $_donnees_r['Titre'] == $_titre and $_donnees_r['Auteurs'] == $_auteurs and $_donnees_r['Lieu'] == $_lieu and $_donnees_r['Commentaires'] == $_comments and $_donnees_r['Format'] == $_format){
					//On cherche d'autres résultats identiques, et on les garde en mémoire
					if ($_idUser2 == 0){
						$_idUser2 = $_donnees_r['ID_Membre'];
						$_timeStamp2 = $_donnees_r['Trans_Date'];
					} elseif($_idUser3 == 0){
						$_idUser3 = $_donnees_r['ID_Membre'];
						$_timeStamp3 = $_donnees_r['Trans_Date'];
					}
				}
			}

			if ($_idUser2 != 0 and $_idUser3 !=0){
				//Si on en a trouvé deux autres, on update la réponse, on augmente les points des trois et on donne un point supplémentaire au premier
				$_sql_ul_d = "UPDATE documents SET C1_Rep = '" .$_c1."', C2_Rep = '" .$_c2."', C3_Rep = '" .$_c3."', Titre_Rep = '" .$_titre."', Auteurs_Rep = '" .$_auteurs."', Lieu_Rep = '" .$_lieu."', Comments_Rep = '" .$_comments."', Format_Rep = '" .$_format."' WHERE ID_Document = ".$_idDocument;
				$_sql_ul_m = "UPDATE membres SET Trans_Valid = Trans_Valid +1 WHERE ID_Membre = ".$_idMembre." or ID_Membre = " .$_idUser2. " or ID_Membre = " .$_idUser3;
				$_sql_ul_r = "UPDATE results SET Trans_Echec = 1 WHERE ID_Document = ". $_idDocument ." AND NOT(ID_Membre = ".$_idMembre." or ID_Membre = " .$_idUser2. " or ID_Membre = " .$_idUser3. ")";
				if ($_timeStamp2>$_timeStamp3){
					$_sql_ul_m_2 = "UPDATE membres SET Point_Premier = Point_Premier +1 WHERE ID_Membre = " .$_idUser3;
				} else {
					$_sql_ul_m_2 = "UPDATE membres SET Point_Premier = Point_Premier +1 WHERE ID_Membre = " .$_idUser2;
				}

				mysqli_query($_bdd, $_sql_ul_d);
				mysqli_query($_bdd, $_sql_ul_m);
				mysqli_query($_bdd, $_sql_ul_r);
				mysqli_query($_bdd, $_sql_ul_m_2);
				mysqli_close($_bdd);
			}
		}
	}

	function give_point_admin($_idDocument,$_c1, $_c2, $_c3, $_auteurs, $_titre, $_lieu, $_comments, $_format){
		$_bdd = requete_bdd();
		$_sql_dl_r = "SELECT ID_Membre, Trans_Date, Cote1, Cote2, Cote3, Titre, Auteurs, Lieu, Commentaires, Format FROM results WHERE ID_Document = '" . $_idDocument . "'";
		$_resultat_r = mysqli_query($_bdd, $_sql_dl_r);
		while ($_donnees_r = mysqli_fetch_assoc($_resultat_r)){
			if ($_donnees_r['Cote1'] == $_c1 and $_donnees_r['Cote2'] == $_c2 and $_donnees_r['Cote3'] == $_c3 and $_donnees_r['Titre'] == $_titre and $_donnees_r['Auteurs'] == $_auteurs and $_donnees_r['Lieu'] == $_lieu and $_donnees_r['Commentaires'] == $_comments and $_donnees_r['Format'] == $_format){
				$_sql_ul_m = "UPDATE membres SET Trans_Valid = Trans_Valid +1 WHERE ID_Membre = ".$_donnees_r['ID_Membre'];
				mysqli_query($_bdd, $_sql_ul_m);
			}
		}
		mysqli_close($_bdd);
	}

	function give_succes($_user){
		$_bdd = requete_bdd();

		//On récupère les informations des membres
		$_sql_dl_m = "SELECT ID_Membre, Trans_Valid FROM membres WHERE Email = '" .$_user. "'";
		$_resultat_m = mysqli_query($_bdd, $_sql_dl_m);
		$_donnees_m = mysqli_fetch_assoc($_resultat_m);

		//On récupère les informations des résultats
		$_sql_dl_r = "SELECT SUM(Trans_Echec) AS Total_Echec, SUM(Trans_Illisible) AS Total_Illisible, MAX(Trans_Date) AS Last_Trans FROM results WHERE ID_Membre = " .$_donnees_m['ID_Membre'];
		$_resultat_r = mysqli_query($_bdd, $_sql_dl_r);
		$_donnees_r = mysqli_fetch_assoc($_resultat_r);


		//On récupère les informations des succès
		$_sql_dl_s = "SELECT * FROM succes WHERE ID_Membre = ".$_donnees_m['ID_Membre'];
		$_resultat_s = mysqli_query($_bdd, $_sql_dl_s);
		$_donnees_s = mysqli_fetch_assoc($_resultat_s);

		//On initialise les variables
		$_valid = "";
		$_echec = "";
		$_illisible = "";
		$_connection = "";
		$_semaine = "";
		$_vitesse = "";
		$_nuit = "";

		//On test pour les succès de réussite
		if (!$_donnees_s['1_R'] and $_donnees_m['Trans_Valid'] >=1){
			$_valid = "1_R = 1, ";
		} elseif (!$_donnees_s['10_R'] and $_donnees_m['Trans_Valid'] >=10){
			$_valid = "10_R = 1, ";
		} elseif (!$_donnees_s['100_R'] and $_donnees_m['Trans_Valid'] >=100){
			$_valid = "100_R = 1, ";
		} elseif (!$_donnees_s['666_R'] and $_donnees_m['Trans_Valid'] >=666){
			$_valid = "666_R = 1, ";
		} elseif (!$_donnees_s['1000_R'] and $_donnees_m['Trans_Valid'] >=1000){
			$_valid = "1000_R = 1, ";
		} elseif (!$_donnees_s['10000_R'] and $_donnees_m['Trans_Valid'] >=10000){
			$_valid = "10000_R = 1, ";
		}

		//On test pour les succès d'echec
		if (!$_donnees_s['10_E'] and $_donnees_r['Total_Echec'] >=10){
			$_echec = "10_E = 1, ";
		} elseif (!$_donnees_s['100_E'] and $_donnees_r['Total_Echec'] >=100){
			$_echec = "100_E = 1, ";
		}

		//On test pour les succès d'illisibilité
		if (!$_donnees_s['10_I'] and $_donnees_r['Total_Illisible'] >=10){
			$_illisible = "10_I = 1, ";
		} elseif (!$_donnees_s['50_I'] and $_donnees_r['Total_Illisible'] >=50){
			$_illisible = "50_I = 1, ";
		}


		//On test si il y a eu 7 jours de transcriptions consécutifs
		if (!$_donnees_s['Trans_Semaine']){
			$_sql_dl_r_2 = "SELECT Trans_Date, COUNT(*) as Nombre_Lignes, MAX(Trans_Date) AS Last_Trans, MIN(Trans_Date) AS First_Trans FROM (SELECT DISTINCT Trans_Date FROM results WHERE ID_Membre = ".$_donnees_m['ID_Membre']." GROUP BY FLOOR(Trans_Date / 86400) DESC LIMIT 7) AS T";
			$_resultat_r_2 = mysqli_query($_bdd, $_sql_dl_r_2);
			$_donnees_r_2 = mysqli_fetch_assoc($_resultat_r_2);
			if ($_donnees_r_2['Nombre_Lignes'] == 7 and (floor($_donnees_r_2['Last_Trans']/86400) == floor($_donnees_r_2['First_Trans']/86400) - 6)){
				$_semaine = "Trans_Semaine = 1, ";
			}
		}

		//On test s'il y a eu 3 transcriptions en moins de 2 minutes
		if (!$_donnees_s['3_en_moins_de_2']){
			$_sql_dl_r_3 = "SELECT COUNT(*) as Nombre_Trans, MAX(Trans_Date) AS Last_Trans, MIN(Trans_Date) AS First_Trans FROM (SELECT Trans_Date FROM results WHERE ID_Membre = ".$_donnees_m['ID_Membre']." ORDER BY Trans_Date DESC LIMIT 3) AS T";
			$_resultat_r_3 = mysqli_query($_bdd, $_sql_dl_r_3);
			$_donnees_r_3 = mysqli_fetch_assoc($_resultat_r_3);
			if ($_donnees_r_3['Nombre_Trans'] == 3 and ($_donnees_r_3['Last_Trans'] > ($_donnees_r_3['First_Trans'] - 120))){
				$_vitesse = "3_en_moins_de_2 = 1, ";
			}
		}
		
		//On test si la dernière transcription a eu lieu la nuit
		if (!$_donnees_s['Trans_Nuit']){
			$_time = date('H:i:s', strtotime($_donnees_r['Last_Trans']));
			if ($_time > date("H:i:s", strtotime("20:00:00")) or $_time < date("H:i:s", strtotime("07:00:00"))){
				$_nuit = "Trans_Nuit = 1, ";
			}
		}

		//On retire la virgule finale de la requête
		$_requete_set = preg_replace('#(, )$#','',$_valid.$_echec.$_illisible.$_connection.$_semaine.$_vitesse.$_nuit);

		$_sql_ul = "UPDATE succes SET ".$_requete_set." WHERE ID_Membre = ".$_donnees_m['ID_Membre'];
		mysqli_query($_bdd, $_sql_ul);
		mysqli_close($_bdd);
	}

	function give_succes_connection($_idMembre, $_connection){
		$_bdd = requete_bdd();
		$_sql_dl = "SELECT Non_Connexion_Semaine FROM succes WHERE ID_Membre = ".$_idMembre;
		$_resultat = mysqli_query($_bdd, $_sql_dl);
		$_donnees = mysqli_fetch_assoc($_resultat);
		if (!$_donnees['Non_Connexion_Semaine'] and ($_connection < time() - 604800)){
			$_bdd = requete_bdd();
			$_sql_ul = "UPDATE succes SET Non_Connexion_Semaine = 1 WHERE ID_Membre = ".$_idMembre;
			mysqli_query($_bdd, $_sql_ul);
		}
		mysqli_close($_bdd);
	}

	function affiche_succes($_user){
		$_bdd = requete_bdd();

		$_sql_dl_m = "SELECT ID_Membre FROM membres WHERE Email = '" .$_user. "'";
		$_resultat_m = mysqli_query($_bdd, $_sql_dl_m);
		$_donnees_m = mysqli_fetch_assoc($_resultat_m);

		$_sql_dl_s = "SELECT * FROM succes WHERE ID_Membre = ".$_donnees_m['ID_Membre'];
		$_resultat_s = mysqli_query($_bdd, $_sql_dl_s);
		$_donnees_s = mysqli_fetch_assoc($_resultat_s);

		echo '';
	}





	//Fonction pour initialiser la BDD de fiches
/*	function fiches($_lettre, $_compteur){
		$_bdd = requete_bdd();
		for ($i=1; $i <$_compteur ; $i++) { 

			$_nombre = $i;
			$_milliers = floor($_nombre/1000);
			$_nombre = $_nombre%1000;
			$_centaines = floor($_nombre/100);
			$_nombre = $_nombre%100;
			$_dizaines = floor($_nombre/10);
			$_nombre = $_nombre%10;
			$_unités = $_nombre;

			$_sql = "INSERT INTO documents(Chemin) VALUES ('banqueImage/Fiches/R-cat-". $_lettre ."/R_". $_lettre ."-". $_milliers ."". $_centaines ."". $_dizaines ."". $_unités .".jpg')";
			mysqli_query($_bdd, $_sql);
		}
	}*/

?>

	