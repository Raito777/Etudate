<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//connexion à la bdd
$bdd = getBdd();
//requete pour récupérer toutes les questions
$questions = $bdd->query('SELECT * FROM questions');

?>

<div class="quizz-div">
    <form action="" method="Post">
    <?php 
        //on parcours toute les questions 1 par 1
        while($question = $questions->fetch()) {
            //on cherche les reponses qui correspondent à l'id de la question où on est
            $reponses = $bdd->prepare('SELECT * FROM reponses WHERE id_Question = ?');
            $reponses->execute([$question['id_Question']]);

    ?>

    <div class="question">

        <p><?= $question['intitule_Question'] ?></p>
        
        <div class="reponse">

            <?php
                //on parcourt les reponses 
                while($reponse = $reponses->fetch()) {
            ?>

                <div>
                    <input type="radio" id="<?= "reponse".$reponse['idReponse_Reponses'] ?>" name="<?= "question".$question['id_Question'] ?>" value="<?= "reponse".$reponse['idReponse_Reponses'] ?>" required>
                    <label for="<?= "reponse".$reponse['idReponse_Reponses'] ?>"><?= $reponse['reponse_Reponses'] ?></label>
                </div>

            <?php
                }
            ?>

        </div>

    </div>
    <?php 
        }
    ?>
    <input class="submit" type="submit" value="Valider">
    </form>
</div>