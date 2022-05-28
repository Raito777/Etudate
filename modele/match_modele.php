<?php

function getUserResponse($idUser){
    $bdd = getBdd();
    $req = $bdd->query("SELECT * FROM repond WHERE id_Utilisateurs = $idUser");
    return $req;
}

function getOrientationOfUser($idUser){
    $bdd = getBdd();
    $attirance = $bdd->prepare("SELECT attirance_Utilisateurs FROM utilisateurs WHERE id_Utilisateurs=?");
    $attirance->execute(array($idUser));
    return $attirance->fetch();
}

function getSexeOfUser($idUser){
    $bdd = getBdd();
    $sexe = $bdd->prepare("SELECT sexe_Utilisateurs FROM utilisateurs WHERE id_Utilisateurs=?");
    $sexe->execute(array($idUser));
    return $sexe->fetch();
}

function findCorresponding($attirance, $orientation){
    $bdd = getBdd();
    $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE sexe_Utilisateurs = ? AND attirance_Utilisateurs = ?");
    $req->execute(array($attirance, $orientation));
    return $req;
    
}

function isAlreadyMatch($idUser1,$idUser2){

    if($idUser1 == $idUser2){
        return true;
    }

    $bdd = getBdd();
    $match = $bdd->prepare("SELECT * FROM compatible WHERE id_Utilisateurs_1 = ? AND id_Utilisateurs_2 = ? ");
    $match->execute(array($idUser1,$idUser2));
    $matchexist =$match->rowCount();

    $match2 = $bdd->prepare("SELECT * FROM compatible WHERE id_Utilisateurs_1 = ? AND id_Utilisateurs_2 = ? ");
    $match2->execute(array($idUser2,$idUser1));
    $matchexist2 = $match2->rowCount();

    if($matchexist2>0 || $matchexist>0){
        return true;
    }

    return false;
}

function findExistingMatchs($idUser1){

    $bdd = getBdd();
    $match = $bdd->prepare("SELECT * FROM compatible WHERE date_Matchs IS NOT NULL AND (id_Utilisateurs_1 = ? OR id_Utilisateurs_2 = ?)");
    $match->execute(array($idUser1, $idUser1));

    return $match;

}

function findUserFromId($idUser1){
    $bdd = getBdd();
    $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE id_Utilisateurs = ?");
    $req->execute(array($idUser1));
    return $req;
}

function insertMatchNo($idUser1, $idUser2){
    $bdd = getBdd();
    $insertmatch = $bdd->prepare('INSERT INTO compatible (id_Utilisateurs_1, id_Utilisateurs_2) VALUES( ?, ?)');
    $insertmatch->execute(array($idUser1, $idUser2));
    echo "<meta http-equiv='refresh' content='0'>";
    return $insertmatch;
}

function insertMatchYes($idUser1, $idUser2){
    $bdd = getBdd();
    $insertmatch = $bdd->prepare('INSERT INTO compatible (id_Utilisateurs_1, 	id_Utilisateurs_2, date_Matchs) VALUES(?, ?, now())');
    $insertmatch->execute(array($idUser1, $idUser2));
    echo "<meta http-equiv='refresh' content='0'>";
    return $insertmatch;
}




?>