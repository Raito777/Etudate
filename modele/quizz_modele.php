<?php

function getQuestions(){
    $bdd = getBdd();
    $req = $bdd->query('SELECT * FROM questions');
    return $req;
}

function getResponses($question){
    $bdd = getBdd();
    $responses = $bdd->prepare('SELECT * FROM reponses WHERE id_Question = ?');
    $responses->execute([$question['id_Question']]);
    return $responses;
}

function insertResponses($arrResponses,$index,$idUser){
    $bdd = getBdd();
    $reqRep = $bdd->prepare('INSERT INTO repond (idReponse_Reponses,id_Utilisateurs) VALUES(?,?)');
    $reqRep->execute(array($arrResponses[$index],$idUser));
}

function hasAlreadyRespond($idUser){
    $bdd = getBdd();
    $reqRep = $bdd->prepare("SELECT * FROM repond WHERE id_Utilisateurs = ?");
    $reqRep->execute(array($idUser));

    $reqRepExist = $reqRep->rowCount();

    if($reqRepExist>0){
        return true;
    }
    else{
        return false;
    }

}


?>