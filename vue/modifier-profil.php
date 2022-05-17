<?php

//connexion à la bdd
$bdd = getBdd();

$erreur = "";

    if(isset($_POST['submitmodif'])) {

        $mail = trim(htmlspecialchars($_POST['mail']));
        $mdp = sha1($_POST['mdp']);


        if(!empty($_POST['mdp'])){
            $mdplength = strlen($_POST['mdp']);
            if($mdplength >= 6){
                $insertmdp = $bdd->prepare("UPDATE utilisateurs SET mdp_Utilisateurs = ?  WHERE id_Utilisateurs=?");
                $insertmdp->execute(array($mdp,$_SESSION['IdUtilisateur']));
            }
            else{
                $erreur = "Mot de passe trop court ! (6 caractères minimum)";
            }

        }
        if(!empty($_POST['mail'])){
            $insertemail = $bdd->prepare("UPDATE utilisateurs SET email_Utilisateurs = ? WHERE id_Utilisateurs=?");
            $insertemail->execute(array($mail, $_SESSION['IdUtilisateur']));
            $_SESSION['MailUtilisateur'] = $mail;

        }


    }




?>


?>
<form action="" method="POST">
<div class="global-profile">
<div class="top-profile">
    <div class="image-profile">
    <img src="../vue/img/<?= $_SESSION['PhotoUtilisateurs'] ?>" alt="photo de profil">
    </div>
    <div class="nom">
    <h3><?= $_SESSION['PrenomUtilisateur'] ?></h3>
    <!-- <p> étudiant en médecine</p> -->
    </div>
    <input type="submit" value="Enregistrer les modifications" name="submitmodif" class="connexion">
</div>


<div class="profile-content">
    <form   action="" method="Post" >
        <div class="connexion-detail">

                <h3>Email</h3>
                <input type="text" name="mail" value="<?= $_SESSION['MailUtilisateur'] ?>" />
                <h3>Mot de passe</h3>
                <input type="password" name="mdp" placeholder="Mot de passe" value="" />

        </div>
    </form>
<a href="quizz" class="connexion">Faire le questionnaire !</a>
</div>

</div>
</form>
