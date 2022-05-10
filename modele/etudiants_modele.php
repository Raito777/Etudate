<?php


function getUserProfil($idUser){
    $bdd = getBdd();
    $req = $bdd->query("SELECT email_Utlisateurs, mdp_Utilisateurs FROM utilisateurs WHERE id_Utilisateurs = $idUser");

    return $req;
}

function inscription($prenom, $mdp, $genre, $orientation, $mail){
    $bdd = getBdd();
    $insertmbr = $bdd->prepare('INSERT INTO utilisateurs (prenom_Utilisateurs, mdp_Utilisateurs, sexe_Utilisateurs, attirance_Utilisateurs, email_Utilisateurs, dateInscription_Utilisateurs, photo_Utilisateurs) VALUES(?, ?, ?, ?, ?, now(), "pp_0.svg")');
    $insertmbr->execute(array($prenom, $mdp, $genre, $orientation, $mail));
    return $insertmbr;
}



?>