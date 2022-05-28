<?php

	function chargerPage($temp, $datatab=array()){

		//On envoit le titre de la page HTML à la vue
		// Ici titre par défaut au cas où
		if(!isset($datatab['title'])){
			$title="Etudate";
		}

		foreach ($datatab as $key=>$val)
		{
			$$key = $val;
		}

	   include('./vue/'.$temp);
	}

	//Page Accueil

	function pageAccueil() {

		//fonction commune, unqiue, chargé de créer le contenu
		//dynamique de la vue
		$data['title']="Accueil - Etudate";

        chargerPage("head.php",$data);
        chargerPage("nav.php");
		chargerPage("accueil.php");
		chargerPage("footer.html");

    }

	function checkConnexion(){
		$erreur = "";
		if(isset($_POST['formconnexion'])) {
			$mailconnect = htmlspecialchars($_POST['mailconnect']);
			$mdpconnect = sha1($_POST['mdpconnect']);
			if(!empty($mailconnect) AND !empty($mdpconnect)) {
			   $userinfo = getUserFromConnexion($mailconnect, $mdpconnect); 
			   if($userinfo != -1) {
				 $_SESSION['IdUtilisateur'] = $userinfo['id_Utilisateurs'];
				 $_SESSION['PrenomUtilisateur'] = $userinfo['prenom_Utilisateurs'];
				 $_SESSION['MailUtilisateur'] = $userinfo['email_Utilisateurs'];
				 $_SESSION['PhotoUtilisateurs'] =  $userinfo['photo_Utilisateurs'];
				 header('location: profil');
				 echo "connecté ".$_SESSION['PrenomUtilisateur'];
			   } else{
				 $erreur = "Mauvais mail ou mot de passe";
			   }
			} else {
			   $erreur = "Tous les champs doivent être complétés !";
			}
		 }
		return $erreur;
	}

	//Page connexion
	function pageConnexion() {

		//fonction commune, uniqueue, chargé de créer le contenu
		//dynamique de la vue
		$data['title']="Connexion - Etudate";

        chargerPage("head.php",$data);
        chargerPage("nav.php");
        chargerPage("connexion.php");
        chargerPage("footer.html");

    }

	//Page deconnexion
	function deconnexionUser(){
		session_start();
		$_SESSION = array();
		session_destroy();
		header("Location: accueil");

	}
	//Page modifier profil
	function pageModifierProfil(){
		$data['title']="ModifierProfil- Etudate";

		
		chargerPage("nav.php");

        chargerPage("formulaire_profil.php");

		chargerPage("head.php",$data);
		
        chargerPage("footer.html");
	}


	function checkModifProfil(){
		$erreur = "";
		$bdd = getBdd();
		$erreur = "";
		ob_start();
			if(isset($_POST['submitmodif'])) {
				$mail = trim(htmlspecialchars($_POST['mail']));
				$mdp = sha1($_POST['mdp']);
				if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
					$tailleMax = 2097152;
					$extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
					if($_FILES['avatar']['size'] <= $tailleMax) {
					   $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
					   if(in_array($extensionUpload, $extensionsValides)) {;
						  $chemin = "vue/img/avatar/".$_SESSION['IdUtilisateur'].".".$extensionUpload;
						  $photoresize = resize_crop_image(500, 500, $_FILES['avatar']['tmp_name'] , $_FILES['avatar']['tmp_name']);
						  $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
						  if($resultat) {
							 $updateavatar = $bdd->prepare('UPDATE utilisateurs SET photo_Utilisateurs = :avatar WHERE id_Utilisateurs = :id');
							 $updateavatar->execute(array(
								'avatar' => $_SESSION['IdUtilisateur'].".".$extensionUpload,
								'id' => $_SESSION['IdUtilisateur']
								));
							 $_SESSION['PhotoUtilisateurs']=$_SESSION['IdUtilisateur'].".".$extensionUpload;                       
						  } else {
							 $erreur = "Erreur durant l'importation de votre photo de profil";
						  }
					   } else {
						  $erreur = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
					   }
					} else {
					   $erreur = "Votre photo de profil ne doit pas dépasser 2Mo";
					}
				}
				if(!empty($_POST['mdp'])){
					$mdplength = strlen($_POST['mdp']);
					if($mdplength >= 6){
						$insertmdp = $bdd->prepare("UPDATE utilisateurs SET mdp_Utilisateurs = ?  WHERE id_Utilisateurs=?");
						$insertmdp->execute(array($mdp,$_SESSION['IdUtilisateur']));
						
							
					}
					else{
						$erreur = "Mot de passe trop court ! (6 caractères minimum)";
					}                          
				}
				if(!empty($_POST['mail'])){
					if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
						$reqmail = $bdd->prepare('SELECT * FROM utilisateurs WHERE email_Utilisateurs = ?');
						$reqmail->execute(array($mail));
						$mailexist = $reqmail->rowCount();
							if($mailexist == 0) {
						$insertemail = $bdd->prepare("UPDATE utilisateurs SET email_Utilisateurs = ? WHERE id_Utilisateurs=?");
						$insertemail->execute(array($mail, $_SESSION['IdUtilisateur']));
						$_SESSION['MailUtilisateur']=$mail;  
						 
									
						}
						else{
							if($mail!=$_SESSION['MailUtilisateur']){
								$erreur="Adresse mail déjà utilisée !";
							}       
						}
					ob_flush();					}
					else{
						$erreur = "Votre adresse mail n'est pas valide !";
					}   
				} 
				if(!empty($_POST['mail']) || !empty($_POST['mdp']) || !empty($_FILES['avatar']['name']) ){
					header("Location: profil");
				}    
			}
	
		// if(isset($erreur)){
		// 	header("Location: modifier-profil");  
		// }
		return $erreur;
	}

	//Page inscription

	function pageInscription() {
		//fonction commune, uniqueue, chargé de créer le contenu
		//dynamique de la vue
		$data['title']="Inscription - Etudate";

		chargerPage("head.php",$data);

        chargerPage("nav.php");

        chargerPage("inscription.php");

        chargerPage("footer.html");
	}

	function checkInscription(){
		$erreur = "";
		if(isset($_POST['forminscription'])) {

			$prenom = trim(htmlspecialchars($_POST['prenom']));
			$mail = trim(htmlspecialchars($_POST['adressemail']));
			$genre = htmlspecialchars($_POST['genre']);
			$orientation = htmlspecialchars($_POST['orientation']);
			$mdp = sha1($_POST['mdp']);
			$confirmationMDP = sha1($_POST['confirmationMDP']);
	
			if(!empty($_POST['prenom']) AND !empty($_POST['adressemail']) AND !empty($_POST['genre']) AND !empty($_POST['orientation']) AND !empty($_POST['mdp']) AND !empty($_POST['confirmationMDP'])){
				$prenomlength = strlen($prenom);
				if($prenomlength <= 64 AND $prenomlength >= 2 AND !empty($_POST['prenom'])) {
					if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
						$reqmail = getUserFromMail($mail);
						$mailexist = $reqmail->rowCount();
						if($mailexist == 0) {
							$mdplength = strlen($_POST['mdp']);
							if($mdplength >= 6){
								if($mdp == $confirmationMDP) {
									if($genre == "homme" OR $genre == "femme" OR $genre == "autre"){
										if($orientation == "hommes" OR $orientation == "femmes" OR $orientation == "autres"){
										setUserPhoto("pp_0.svg");
	
										// $insertmbr = $bdd->prepare('INSERT INTO utilisateurs (prenom_Utilisateurs, mdp_Utilisateurs, sexe_Utilisateurs, 	attirance_Utilisateurs, email_Utilisateurs, dateInscription_Utilisateurs, photo_Utilisateurs) VALUES(?, ?, ?, ?, ?, now(), "pp_0.svg")');
										// $insertmbr->execute(array($prenom, $mdp, $genre, $orientation, $mail));
										$inscription = inscription($prenom, $mdp, $genre, $orientation, $mail);
	
										$erreur = _("Votre compte a bien été créé !");
										$_SESSION['IdUtilisateur'] = 0;
										header("Location: connexion");
	
										}else{
											$erreur = "L'attirance doit être Les hommes, Les femmes ou Autre";
										}
									}else{
										$erreur = "Le genre doit être homme, femme ou autre";
									}
								}else{
									$erreur = "Vos mots de passe ne correspondent pas !";
								}
							}else{
								$erreur = "Mot de passe trop court ! (6 caractères minimum)";
							}
						}else{
							$erreur = "Adresse mail déjà utilisée !";
						}
					}else{
						$erreur = "Votre adresse mail n'est pas valide !";
					}
				}else{
					$erreur = "Votre prénom doit contenir au minimum 2 et au maximum 64 caractères";
				}
			}else{
				$erreur = "Tous les champs doivent être complétés !";
			}
		}

		return $erreur;
	
	}



	function pageProfil(){

		$data['title']="Profil - Etudate";

		chargerPage("head.php",$data);

        chargerPage("nav.php");

        chargerPage("profil.php");

        chargerPage("footer.html");

	}

	





	// Quizz Page


	function recupereQuestions(){
		return $questions = getQuestions();
	}

	function recupereReponses($question){
		return $reponses = getResponses($question);
	}

	function addReponsesToUser(){
		if(isset($_POST['quizz'])){

			$arrResponses;
		
			for($index = 0; $index < 16; $index++) {
				//ajoute l'id de la reponse au tableau
				$arrResponses[$index] = htmlspecialchars($_POST['question'.($index+1)]);
				//insert les reponses dans la bdd
				$reqRep = insertResponses($arrResponses,$index,getUserId());
			}
		
		}
	}

	function pageQuizz(){

		$data['title']="Quizz - Etudate";

		chargerPage("head.php",$data);

		chargerPage("nav.php");

		chargerPage("quizz.php");

		chargerPage("footer.html");

	}


	// USER INFORMATIONS	

	function sessionConnexion(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}

	function getUserPhoto(){
		return $_SESSION['PhotoUtilisateurs'];
	}

	function setUserPhoto($photo){
		$_SESSION['PhotoUtilisateurs'] = $photo;
	}

	function getUserName(){
		return $_SESSION['PrenomUtilisateur'];
	}

	function getUserEmail(){
		return $_SESSION['MailUtilisateur'];
	}

	function setUserEmail($mail){
		$_SESSION['MailUtilisateur'] = $mail;
	}

	function getUserId(){
		if(isset($_SESSION['IdUtilisateur'])){
			return $_SESSION['IdUtilisateur'] ;
		}
		else{
			return -1;
		}
	}

	function checkUserSet(){
		if(getUserId() == -1 || getUserId() == 0){
			return 0;
		}
		else{
			return 1;
		}
	}



	sessionConnexion();


?>
