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


	function pageAccueil() {

		//fonction commune, unqiue, chargé de créer le contenu
		//dynamique de la vue
		$data['title']="Accueil - Etudate";

        chargerPage("head.php",$data);
        chargerPage("nav.php");
		chargerPage("accueil.php");
		chargerPage("footer.html");

    }


	function pageConnexion() {

		//fonction commune, uniqueue, chargé de créer le contenu
		//dynamique de la vue
		$data['title']="Connexion - Etudate";

        chargerPage("head.php",$data);
        chargerPage("nav.php");
        chargerPage("connexion.php");
        chargerPage("footer.html");

    }


	function pageInscription() {
		//fonction commune, uniqueue, chargé de créer le contenu
		//dynamique de la vue
		$data['title']="Inscription - Etudate";

		chargerPage("head.php",$data);

        chargerPage("nav.php");

        chargerPage("inscription.php");

        chargerPage("footer.html");
	}



	function pageProfil(){

		$data['title']="Profil - Etudate";

		chargerPage("head.php",$data);

        chargerPage("nav.php");

        chargerPage("profil.php");

        chargerPage("footer.html");

	}

	function pageDeconnexion(){

		chargerPage("deconnexion.php");

	}
	function pageModifierProfil(){
		$data['title']="ModifierProfil- Etudate";

		chargerPage("head.php",$data);

		chargerPage("nav.php");

        chargerPage("formulaire_profil.php");

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
				$reqRep = insertResponses($arrResponses,$index,$_SESSION['IdUtilisateur']);
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

	// Profil page 
	
	function getUserPhoto(){
		return getUserProfilPicture();
	}

	function getUserName(){
		return getUserProfilName();
	}

	function getUserEmail(){
		return getUserProfilMail();
	}

?>
