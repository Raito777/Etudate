<?php

function getUserResponse($idUser){
    $bdd = getBdd();
    $req = $bdd->query("SELECT * FROM repond WHERE id_Utilisateurs = $idUser");
    return $req;
}


?>