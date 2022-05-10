<?php


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                $reqmail = $bdd->prepare('SELECT * FROM utilisateurs WHERE email_Utilisateurs = ?');
                $reqmail->execute(array($mail));
                $mailexist = $reqmail->rowCount();
                    if($mailexist == 0) {

                $insertemail = $bdd->prepare("UPDATE utilisateurs SET email_Utilisateurs = ? WHERE id_Utilisateurs=?");
                $insertemail->execute(array($mail, $_SESSION['IdUtilisateur']));
                $_SESSION['MailUtilisateur']=$mail;
                
                }
                else{
                    if($mail!=$_SESSION['MailUtilisateur']){
                        $erreur="Adresse mail déjà utilisée !";
                    }
                    
                }
            }
            else{
                $erreur = "Votre adresse mail n'est pas valide !";
            }
             
        }
    }
    
        
   

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
                <p id="message-erreur"><?= $erreur ?></p>

        </div>
    </form>
<a href="quizz" class="connexion">Faire le questionnaire !</a>
</div>

</div>
</form>