<?php

	require_once("modele/bdd/bdd.php");
	require_once("modele/etudiants_modele.php");
	require_once("modele/quizz_modele.php");
	require_once("modele/match_modele.php");

	
	require_once('controleur/controleur.php');

	$page = explode('/',$_SERVER['REQUEST_URI']);

	$method = $_SERVER['REQUEST_METHOD'];

	sessionConnexion();

	//This part is the routing process : depending the different url elements, we dispatch 
	switch($page[3]) {
		case 'inscription' : 
			pageInscription();
			break;
		case 'connexion' :
				pageConnexion();
			break;
		case 'deconnexion' :
		if(getUserId() != -1 && getUserId() != 0){
			deconnexionUser();
		}
		else{
			pageConnexion();
		}
			break;
		case 'accueil' :
				pageAccueil();
				break;	
		case 'quizz' :
			if(getUserId() != -1 && getUserId() != 0){
				if(!formCompleted()){
					pageQuizz();
				}
			}
			else{
				pageConnexion();
			}
				break;
		case 'profil':
			if(getUserId() != -1 && getUserId() != 0){
				pageProfil();
			}
			else{
				pageConnexion();
			}
				break;
		case 'modifier-profil' :
			if(getUserId() != -1 && getUserId() != 0){
				pageModifierProfil();
			}
			else{
				pageConnexion();
			}
				break;
		case 'match' :
			if(getUserProfilId() != -1 && getUserProfilId() != 0){
				pageMatch();
			}else{
				pageConnexion();
			}
				break;
		 default : 
		 	http_response_code('500');
			echo '404';
			break;
	}

    ?>