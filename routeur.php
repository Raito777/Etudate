<?php

	require_once("modele/bdd/bdd.php");
	require_once("modele/etudiants_modele.php");

	
	require_once('controleur/controleur.php');

	$page = explode('/',$_SERVER['REQUEST_URI']);

	$method = $_SERVER['REQUEST_METHOD'];




	//This part is the routing process : depending the different url elements, we dispatch 
	switch($page[3]) {
		case 'inscription' : 
			pageInscription();
			break;
		case 'connexion' :
			pageConnexion();
			break;
		case 'deconnexion' :
			pageDeconnexion();
			break;
		case 'accueil' :
				pageAccueil();
				break;	
		case 'quizz' :
				pageQuizz();
				break;
		case 'profil':
				pageProfil();
				break;
		case 'modifier-profil' :
				pageModifierProfil();
				break;
		 default : 
		 	http_response_code('500');
			echo '404';
			break;
	}
    ?>