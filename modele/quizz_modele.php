<?php

function getQuestions(){
    $bdd = getBdd();
    $req = $bdd->query('SELECT * FROM questions');
    return $req;
}


function getResponses($question,$id_Question){
    $responses = $bdd->prepare('SELECT * FROM reponses WHERE id_Question = ?');
    $responses->execute([$question['id_Question']]);
    return $responses;
}



?>