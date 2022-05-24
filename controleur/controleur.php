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

	function pageQuizz(){

		$data['title']="Quizz - Etudate";
		
		chargerPage("head.php",$data);

        chargerPage("nav.php");

        chargerPage("quizz.php");

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



?>