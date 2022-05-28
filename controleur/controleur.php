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

				header("Location:profil");
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

        chargerPage("head.php", $data);

        chargerPage("nav.php");
		
        chargerPage("connexion.php");
		
        chargerPage("footer.html");

    }

	//Page deconnexion
	function deconnexionUser(){
		session_start();
		$_SESSION = array();
		session_destroy();
		header("Location:accueil");
	}
	//Page modifier profil
	function pageModifierProfil(){
		$data['title']="ModifierProfil- Etudate";

		
		chargerPage("nav.php");

        chargerPage("formulaire_profil.php");

		chargerPage("head.php",$data);
		
        chargerPage("footer.html");
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
										
										//echo "<script>window.location.href='connexion';</script>";
										
										header("Location:connexion");
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

	function formCompleted(){
		return hasAlreadyRespond(getUserId());
	}

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
			header("Location:match");
		
		}
	}

	function pageQuizz(){

		$data['title']="Quizz - Etudate";

		chargerPage("head.php",$data);

		chargerPage("nav.php");

		chargerPage("quizz.php");

		chargerPage("footer.html");

	}

	function pageMatch(){

		$data['title']="Match- Etudate";

		chargerPage("head.php",$data);

		chargerPage("nav.php");

        chargerPage("match.php");

        chargerPage("footer.html");

	}

	function getUserFromOrientation(){
		$orientation = getOrientationOfUser($_SESSION["IdUtilisateur"]);
		$userSexe = getSexeOfUser($_SESSION["IdUtilisateur"]);
		$personnes = findCorresponding(substr_replace($orientation[0] ,"",-1), $userSexe[0]."s");
		return $personnes;
	}

	function generateMatch(){
		$personnes=getUserFromOrientation();
		$match=0;
		//$personnes=$personnes->fetch();
		//var_dump($personnes);
		while($personne=$personnes->fetch()){
			if(!isAlreadyMatch($_SESSION["IdUtilisateur"],$personne["id_Utilisateurs"])){
				return $personne;
			}
		}
		return -1;
	}





	// USER INFORMATIONS	

	function sessionConnexion(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}

	function getUserPhoto(){
		if(isset($_SESSION['PhotoUtilisateurs'])){
			return $_SESSION['PhotoUtilisateurs'];
		}
		else{
			return -1;
		}
	}

	function setUserPhoto($photo){
		$_SESSION['PhotoUtilisateurs'] = $photo;
	}

	function getUserName(){
		if(isset($_SESSION['PrenomUtilisateur'])){
			return $_SESSION['PrenomUtilisateur'];
		}
		else{
			return -1;
		}
		
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



	


?>

