    <?php
    

	function chargerPage($temp, $datatab=array()){
		
		//On envoit le titre de la page HTML à la vue
		// Ici titre par défaut au cas où
		if(!isset($datatab['title'])){
			$title="Pas de titre";
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

        chargerPage("head.html",$data);
        chargerPage("nav.html");
		chargerPage("accueil.html");
		chargerPage("footer.html");
		
		
    }
    
    ?>