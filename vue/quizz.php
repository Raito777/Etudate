<?php
require_once("controleur/controleur.php");
?>


<div class="quizz-div">
    <form action="<?php addReponsesToUser(); ?>" method="Post">
    <?php
      $questions = recupereQuestions();
        //on parcours toute les questions 1 par 1
        while($question = $questions->fetch()) {
            //on cherche les reponses qui correspondent à l'id de la question où on est

            $reponses = recupereReponses($question);

    ?>

    <div class="question">

        <p><?= $question['intitule_Question'] ?></p>

        <div class="reponse">

            <?php
                //on parcourt les reponses
                while($reponse = $reponses->fetch()) {
            ?>

                <div>
                    <input type="radio" id="<?= "reponse".$reponse['idReponse_Reponses'] ?>" name="<?= "question".$question['id_Question'] ?>" value="<?= $reponse['idReponse_Reponses'] ?>" required>
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
    <input class="submit" type="submit" name="quizz" value="Valider">
    </form>
</div>
