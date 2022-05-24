<?php
require_once("controleur/controleur.php");
$matchs = getUserFromOrientation();
$theMatch = generateMatch();

$existingMatchs = findExistingMatchs($_SESSION["IdUtilisateur"]);

//var_dump($existingMatchs);

if(isset($_POST['machNo'])) {
    $insertMatchNo = insertMatchNo($_SESSION["IdUtilisateur"], $theMatch["id_Utilisateurs"]);
}else if(isset($_POST['matchYes'])) {
    $insertMatchYes = insertMatchYes($_SESSION["IdUtilisateur"], $theMatch["id_Utilisateurs"]);
}

?>

<form action="" method="POST">

    <div class="match-main-div">
        <div class="match-profile">
            <?php
                if($theMatch != -1){
            ?>
            <div class="image-profile-match">
                <img src="../vue/img/avatar/<?= $theMatch["photo_Utilisateurs"]?>" alt="photo de profil">  
            </div> 
            <div class="nom">
                <h3><?= $theMatch["prenom_Utilisateurs"]?></h3>
                <p><?= $theMatch["email_Utilisateurs"]?></p>
            </div>
            
            <div class="button-match">

                <input class="submit" name="machNo" type="submit" value="Nope">
                <input class="submit" name="matchYes" type="submit" value="Yas">
            
            </div>
            <?php
                }else{
            ?>
                <div class="no-one">
                    <p>Désolé, il n'y a personne compatible :/, revenez plus tard !</p>
                </div>
            <?php
                }
            ?>
        </div>
        
        <div class="match-list">
            <?php

                while($existingMatch = $existingMatchs->fetch()) {
                    //si l'id est égale à l'utilisateurs, alors c'est pas bon, il faut prendre l'autre id du match
                    if($existingMatch["id_Utilisateurs_1"] == $_SESSION["IdUtilisateur"]){
                        $userMatchId = $existingMatch["id_Utilisateurs_2"];
                    }else{
                        $userMatchId = $existingMatch["id_Utilisateurs_1"];
                    }

                    $oneMatchInfos = findUserFromId($userMatchId);

                    while($oneMatchInfo = $oneMatchInfos->fetch()) {

            ?>
                <div class="one-match">
                    <div class="image-profile-list">
                        <img src="../vue/img/avatar/<?= $oneMatchInfo["photo_Utilisateurs"]?>" alt="photo de profil">  
                    </div> 
                    <div class="info">
                        <span><?= $oneMatchInfo["prenom_Utilisateurs"]?>, <?= $oneMatchInfo["email_Utilisateurs"]?></span>
                    </div>
                </div>

            <?php
                    }
                }
            ?>

            <?php
                if($existingMatchs->rowCount()<=0){
            ?>

                <div class="no-one">
                    <p>Ici, se trouveront vos matchs !</p>
                </div>

            <?php
                }
            ?>
        </div>

    </div>



</form>