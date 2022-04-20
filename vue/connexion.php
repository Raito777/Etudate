<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$bdd = getBdd();

$erreur = "";

if(isset($_POST['formconnexion'])) {

	   $mailconnect = htmlspecialchars($_POST['mailconnect']);
	   $mdpconnect = sha1($_POST['mdpconnect']);
	   if(!empty($mailconnect) AND !empty($mdpconnect)) {
	      $requsermail = $bdd->prepare("SELECT * FROM utilisateurs WHERE email_Utilisateurs  = ? AND mdp_Utilisateurs  = ?");
	      $requsermail->execute(array($mailconnect, $mdpconnect));
          $usermailexist = $requsermail->rowCount();
	      if($usermailexist == 1) {
	        $userinfo = $requsermail->fetch();
	        $_SESSION['IdUtilisateur'] = $userinfo['id_Utilisateurs'];
	        $_SESSION['PrenomUtilisateur'] = $userinfo['prenom_Utilisateurs'];
	        $_SESSION['MailUtilisateur'] = $userinfo['email_Utilisateurs'];
            $_SESSION['PhotoUtilisateurs'] =  $userinfo['photo_Utilisateurs'];
            header('location: profil');
            echo "connecté ".$_SESSION['PrenomUtilisateur'];
                        
	      } else{
            $erreur = "Mauvais mail ou mot de passe";
          }
	   } else {
	      $erreur = "Tous les champs doivent être complétés !";
	   }
    }

?>



<div class="connexion-div"><div class="left-connect">
    <?php   
        if(!empty(isset($_SESSION['IdUtilisateur']))) {
            if($_SESSION['IdUtilisateur']==0) {
    ?>
       <p><?=  "Compte créé avec succès !" ?></p>
    <?php
            }
        }
    ?>
    <h3> Connectez-vous </h3>
    <p>et rejoignez d'autres étudiants</p>
 <form action="" method="Post">
     
        <div class="input-div">
            
            <input type="text" name="mailconnect" id ="adressemail" placeholder="Email" minlength="2" value="<?php if(isset($mailconnect)) { echo $mailconnect; } ?>" required>
            <svg xmlns="http://www.w3.org/2000/svg" style="" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M464 64C490.5 64 512 85.49 512 112C512 127.1 504.9 141.3 492.8 150.4L275.2 313.6C263.8 322.1 248.2 322.1 236.8 313.6L19.2 150.4C7.113 141.3 0 127.1 0 112C0 85.49 21.49 64 48 64H464zM217.6 339.2C240.4 356.3 271.6 356.3 294.4 339.2L512 176V384C512 419.3 483.3 448 448 448H64C28.65 448 0 419.3 0 384V176L217.6 339.2z" style=""/></svg>
   
        </div>

        <div class="input-div">
          
          <input type="password" name="mdpconnect" id="motdepasse" placeholder="Mot de passe" minlenght="6" required>
          <svg xmlns="http://www.w3.org/2000/svg" style="" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M282.3 343.7L248.1 376.1C244.5 381.5 238.4 384 232 384H192V424C192 437.3 181.3 448 168 448H128V488C128 501.3 117.3 512 104 512H24C10.75 512 0 501.3 0 488V408C0 401.6 2.529 395.5 7.029 391L168.3 229.7C162.9 212.8 160 194.7 160 176C160 78.8 238.8 0 336 0C433.2 0 512 78.8 512 176C512 273.2 433.2 352 336 352C317.3 352 299.2 349.1 282.3 343.7zM376 176C398.1 176 416 158.1 416 136C416 113.9 398.1 96 376 96C353.9 96 336 113.9 336 136C336 158.1 353.9 176 376 176z" style=""/></svg>
        
        </div>

        <p id="message-erreur"><?= $erreur ?></p>

        <input class="submit" name="formconnexion" type="submit" value="Connexion">
        <a href="inscription">ou créer un compte</a>
    </form>
</div>
    <div class="right-connect">
      <img src="../vue/img/connection_chillax.svg" alt="personne avec un chat">
    </div>
</div>
