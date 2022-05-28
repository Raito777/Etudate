<form action="<?php checkModifProfil();?>" method="POST" enctype="multipart/form-data">
        <div class="global-profile">
        <div class="top-profile">
        <div class="image-profile">
        <img src="../vue/img/avatar/<?php getUserPhoto();?>" alt="photo de profil">  
        </div> 
        <div class="nom">
        <h3><?php getUserName();?></h3>
        <!-- <p> étudiant en médecine</p> -->
        </div>   
        <input type="submit" value="Enregistrer les modifications" name="submitmodif" class="connexion">
        </div>


        <div class="profile-content">   
                <div class="connexion-detail">

                        <h3>Email</h3>
                        <input type="text" name="mail" value="<?php getUserEmail();?>" />
                        <h3>Mot de passe</h3>
                        <input type="password" name="mdp" placeholder="Mot de passe" value="" />
                        
                        <!-- ENLEVER SESSION -->
                        <input type="file" class="connexion" name="avatar"/></br></br>

                </div>
        <a href="quizz" class="connexion">Faire le questionnaire !</a>
        </div>

        </div>
</form>