<?php 


?>

<div class="global-profile">

    <div class="top-profile">
        <div class="image-profile">
        <img src="../vue/img/<?= $_SESSION['PhotoUtilisateurs'] ?>" alt="photo de profil">  
        </div> 
        <div class="nom">
        <h3><?= $_SESSION['PrenomUtilisateur'] ?></h3>
        <!-- <p> étudiant en médecine</p> -->
        </div>   
        <a class="connexion" href="">Modifier mon profil</a>
    </div>

    <div class="profile-content">   
        <form   action="" method="Post" >
            <div class="connexion-detail">

                    <h3>Email</h3>
                    <input type="text" name="pseudo" value="<?= $_SESSION['MailUtilisateur'] ?>" disabled="disabled" />
                    <h3>Mot de passe</h3>
                    <input type="password" name="pseudo" value="motdepasse" disabled="disabled" />

            </div>
        </form>
    <a href="quizz" class="connexion">Faire le questionnaire !</a>
    </div>
    
</div>
