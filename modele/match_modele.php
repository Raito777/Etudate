<?php

function getUserResponse($idUser){
    $bdd = getBdd();
    $req = $bdd->query("SELECT * FROM repond WHERE id_Utilisateurs = $idUser");
    return $req;
}
function getAttirance($idUser){
    $bdd = getBdd();
    $attirance = $bdd->prepare("SELECT attirance_Utilisateurs FROM utilisateurs WHERE id_Utilisateurs=?");
    $attirance->execute(array($idUser));
    return $attirance->fetch();
}

function findOrientation($attirance){
    $bdd = getBdd();
    $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE sexe_Utilisateurs = ? ");
    $req->execute(array($attirance));
    return $req;
    
}

function findMatch($idUser1,$idUser2){
    $bdd = getBdd();
    $match = $bdd->prepare("SELECT * FROM compatible WHERE id_Utilisateurs_1 = ? AND id_Utilisateurs_2 = ? ");
    $match->execute(array($idUser1,$idUser2));
    $matchexist =$match->rowCount();
    if($matchexist==0){
        return $match->fetch();
        
    }
    return 0;
    

}



?>