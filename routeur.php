<?php
	require_once('controleur/controleur.php');
	$page = explode('/',$_SERVER['REQUEST_URI']);
	$method = $_SERVER['REQUEST_METHOD'];




	//This part is the routing process : depending the different url elements, we dispatch 
	switch($page[2]) {
		case 'inscription' : 
			pageInscription();
			break;
		case 'connexion' :
			pageConnexion();
			break;
		case 'accueil' :
				pageAccueil();
				break;	
		 default : 
		 	http_response_code('500');
			echo '404';
			break;
	}
    ?>