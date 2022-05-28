<div class="connexion-div"><div class="left-connect">
    <h3>Inscrivez-vous</h3>
    <p>et rejoignez d'autres étudiants</p>
 <form   action="<?php $erreur = checkInscription();?>" method="Post">
     
        <div class="input-div">
        
            <input type="text" name="prenom" id="prenom" placeholder="Prénom" minlength="2"  maxlength="64" required value="<?php if(isset($prenom)) { echo $prenom; } ?>">

            <svg xmlns="http://www.w3.org/2000/svg" style="" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"/></svg>

        </div>
        <div class="input-div">

            <input type="mail" name="adressemail" id ="adressemail" placeholder="Email" minlength="2" maxlength="128" value="<?php if(isset($mail)) { echo $mail; } ?>" required>

            <svg xmlns="http://www.w3.org/2000/svg" style="" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M464 64C490.5 64 512 85.49 512 112C512 127.1 504.9 141.3 492.8 150.4L275.2 313.6C263.8 322.1 248.2 322.1 236.8 313.6L19.2 150.4C7.113 141.3 0 127.1 0 112C0 85.49 21.49 64 48 64H464zM217.6 339.2C240.4 356.3 271.6 356.3 294.4 339.2L512 176V384C512 419.3 483.3 448 448 448H64C28.65 448 0 419.3 0 384V176L217.6 339.2z" style=""/></svg>
        </div>
        <div class="radio-inscription">

            <legend>Vous êtes</legend>
            <div class="gender-select">
                <div>
                     <input type="radio" name="genre" id="male" value="homme" required <?php if(isset($genre) AND $genre == "male") { echo "checked"; } ?> >
                     <label for="male">Un homme</label>

                </div>
                <div>
                     <input type="radio" name="genre" id="female" value="femme" required <?php if(isset($genre) AND $genre == "femme") { echo "checked"; } ?> >
                     <label for="female">Une femme</label>
                </div>
                <div>
                     <input type="radio" name="genre" id="autre" value="autre" required <?php if(isset($genre) AND $genre == "autre") { echo "checked"; } ?>>
                     <label for="autre">Autre</label>
                </div>
            </div>

            <legend>Attiré par</legend>
            <div class="gender-select">
                <div>
                     <input type="radio" name="orientation" id="aMale" value="hommes" required <?php if(isset($orientation) AND $orientation == "hommes") { echo "checked"; } ?>>
                     <label for="aMale">Les hommes</label>

                </div>
                <div>
                     <input type="radio" name="orientation" id="aFemale" value="femmes" required>
                     <label for="aFemale">Les femmes</label>
                </div>
                <div>
                     <input type="radio" name="orientation" id="another" value="autres" required>
                     <label for="another">Autre</label>
                </div>
            </div>

        </div>
        <div class="input-div">


        <input type="password" name="mdp" id="mdp" placeholder="Mot de passe, 6 caractères minimum" minlenght="6" required>

        <svg xmlns="http://www.w3.org/2000/svg" style="" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M282.3 343.7L248.1 376.1C244.5 381.5 238.4 384 232 384H192V424C192 437.3 181.3 448 168 448H128V488C128 501.3 117.3 512 104 512H24C10.75 512 0 501.3 0 488V408C0 401.6 2.529 395.5 7.029 391L168.3 229.7C162.9 212.8 160 194.7 160 176C160 78.8 238.8 0 336 0C433.2 0 512 78.8 512 176C512 273.2 433.2 352 336 352C317.3 352 299.2 349.1 282.3 343.7zM376 176C398.1 176 416 158.1 416 136C416 113.9 398.1 96 376 96C353.9 96 336 113.9 336 136C336 158.1 353.9 176 376 176z" style=""/></svg>

        </div> 
        <div class="input-div">

        <input type="password" name="confirmationMDP" id="confirmationMDP" placeholder="Confirmation de mot de passe" minlength="6" required>

        <svg xmlns="http://www.w3.org/2000/svg" style="" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M282.3 343.7L248.1 376.1C244.5 381.5 238.4 384 232 384H192V424C192 437.3 181.3 448 168 448H128V488C128 501.3 117.3 512 104 512H24C10.75 512 0 501.3 0 488V408C0 401.6 2.529 395.5 7.029 391L168.3 229.7C162.9 212.8 160 194.7 160 176C160 78.8 238.8 0 336 0C433.2 0 512 78.8 512 176C512 273.2 433.2 352 336 352C317.3 352 299.2 349.1 282.3 343.7zM376 176C398.1 176 416 158.1 416 136C416 113.9 398.1 96 376 96C353.9 96 336 113.9 336 136C336 158.1 353.9 176 376 176z" style=""/></svg>
        

        </div>

        <p id="message-erreur"><?= $erreur ?></p>

        <input class="submit" type="submit" name="forminscription" value="Je m'inscris">

        <a href="connexion">ou Connectez-vous</a>

    </form>

</div>
    <div class="right-connect">
        <img src="../vue/img/inscription.svg" alt="2 personnes sur un telephone">
    </div>
</div>
