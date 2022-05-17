<form action="../modele/modifier_profil.php" method="POST" enctype="multipart/form-data">
<div class="global-profile">
<div class="top-profile">
    <div class="image-profile">
    <img src="../vue/img/avatar/<?= $_SESSION['PhotoUtilisateurs'] ?>" alt="photo de profil">  
    </div> 
    <div class="nom">
    <h3><?= $_SESSION['PrenomUtilisateur'] ?></h3>
    <!-- <p> étudiant en médecine</p> -->
    </div>   
    <input type="submit" value="Enregistrer les modifications" name="submitmodif" class="connexion">
</div>


<div class="profile-content">   
        <div class="connexion-detail">

                <h3>Email</h3>
                <input type="text" name="mail" value="<?= $_SESSION['MailUtilisateur'] ?>" />
                <h3>Mot de passe</h3>
                <input type="password" name="mdp" placeholder="Mot de passe" value="" />
                <p id="message-erreur"><?php if(isset($_SESSION["erreur"])){echo $_SESSION["erreur"];}  ?></p>
                <input type="file" class="connexion" name="avatar"/></br></br>

        </div>
<a href="quizz" class="connexion">Faire le questionnaire !</a>
</div>

</div>
</form>