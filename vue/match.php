<?php
require_once("controleur/controleur.php");
$matchs = getUserFromOrientation();
$theMatch = generateMatch();
var_dump($theMatch);

?>



<form action="" method="POST">
    <div class="match-main-div">
        <div class="match-profile">
            <div class="image-profile-match">
                <img src="../vue/img/avatar/pp_0.svg" alt="photo de profil">  
            </div> 
            <div class="nom">
                <h3><?= $theMatch["prenom_Utilisateurs"]?></h3>
                <p>hippopo@gmail.com</p>
            </div>
            
            <div class="button-match">
                <input class="submit" name="machNo" type="submit" value="Nope">
                <input class="submit" name="matchYes" type="submit" value="Yas">



            </div>

        </div>
    

    </div>
</form>