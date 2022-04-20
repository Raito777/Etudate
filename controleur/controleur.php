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
        chargerPage("nav.html");
		chargerPage("accueil.html");
		chargerPage("footer.html");
		
    }


	function pageConnexion() {
		
		//fonction commune, uniqueue, chargé de créer le contenu
		//dynamique de la vue
		$data['title']="Connexion - Etudate";

        chargerPage("head.php",$data);
        chargerPage("nav.html");
        chargerPage("connexion.html");
        chargerPage("footer.html");
		
    }
    
    
	function pageInscription() {
		//fonction commune, uniqueue, chargé de créer le contenu
		//dynamique de la vue
		$data['title']="Inscription - Etudate";
		
		chargerPage("head.php",$data);

        chargerPage("nav.html");

        chargerPage("inscription.php");

        chargerPage("footer.html");
	}

	function pageQuizz(){

		$data['title']="Quizz - Etudate";
		
		chargerPage("head.php",$data);

        chargerPage("nav.html");

        chargerPage("quizz.php");

        chargerPage("footer.html");

	}

	function pageProfil(){

		$data['title']="Profil - Etudate";
		
		chargerPage("head.php",$data);

        chargerPage("nav.html");

        chargerPage("profil.html");

        chargerPage("footer.html");

	}

?>