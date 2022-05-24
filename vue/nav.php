
<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
?>

<body id="body">

<nav>
    <div class="left-side">
        <div class="logoContent"><a href="accueil"><img src="../vue/img/logo.png" alt="logo d'Etudate">Etudate</a></div>
        <a href="accueil">Accueil</a>
        <a href="accueil">A propos de nous</a>
        <?php
            if(isset($_SESSION['IdUtilisateur']) AND $_SESSION['IdUtilisateur'] != 0) {
        ?>
            <a href="match">Mes matchs</a>
        <?php
            }
        ?>
    </div>
    <div class="right-side">
        <?php
            if(empty(isset($_SESSION['IdUtilisateur'])) OR $_SESSION['IdUtilisateur'] == 0) {
        ?>
            <a href="inscription">Créer un compte</a>
            <a href="connexion" class="connexion">Connexion</a>
        <?php
            } else if($_SESSION['IdUtilisateur'] != 0) {
        ?>
            
            <a href="profil"><?= $_SESSION['PrenomUtilisateur'] ?></a>
            <a href="profil">
                <div class="image-profil-nav">
                    <img src="../vue/img/avatar/<?= $_SESSION['PhotoUtilisateurs'] ?>" alt="photo de profil">  
                </div>
            </a>
            <a href="deconnexion">
                <svg class="deconnexion-svg-nav" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 480h64C177.7 480 192 465.7 192 448S177.7 416 160 416H96c-17.67 0-32-14.33-32-32V128c0-17.67 14.33-32 32-32h64C177.7 96 192 81.67 192 64S177.7 32 160 32H96C42.98 32 0 74.98 0 128v256C0 437 42.98 480 96 480zM504.8 238.5l-144.1-136c-6.975-6.578-17.2-8.375-26-4.594c-8.803 3.797-14.51 12.47-14.51 22.05l-.0918 72l-128-.001c-17.69 0-32.02 14.33-32.02 32v64c0 17.67 14.34 32 32.02 32l128 .001l.0918 71.1c0 9.578 5.707 18.25 14.51 22.05c8.803 3.781 19.03 1.984 26-4.594l144.1-136C514.4 264.4 514.4 247.6 504.8 238.5z"/></svg>
            </a>
        <?php
            }
        ?>
        <svg  onclick="openNav()" class="menuIcon"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z"/></svg>
    </div>

</nav>

<div class="responsive-nav display-none" id="responsive-nav">
    <div class="close-cross" id="close-cross" onclick="closeNav()"></div>
    <div class="logoContent"><a href="accueil"><img src="../vue/img/logo.png" alt="logo d'Etudate">Etudate</a></div>
    <a href="accueil">Accueil</a>
    <a href="">A propos de nous</a>
    <?php
            if(isset($_SESSION['IdUtilisateur']) AND $_SESSION['IdUtilisateur'] != 0) {
        ?>
            <a href="match">Mes matchs</a>
        <?php
            }
        ?>
    <?php
            if(empty(isset($_SESSION['IdUtilisateur'])) OR $_SESSION['IdUtilisateur'] == 0) {
    ?>
        <a href="">Créer un compte</a>
        <a href="" class="connexion">Connexion</a>
    <?php
            } else if($_SESSION['IdUtilisateur'] != 0)  {
    ?>

        <a href="profil"><?= $_SESSION['PrenomUtilisateur'] ?></a>
        <a href="profil">
            <div class="image-profil-nav">
                <img src="../vue/img/avatar/<?= $_SESSION['PhotoUtilisateurs'] ?>" alt="photo de profil">  
            </div>
        </a>
        <a href="deconnexion">
            <svg class="deconnexion-svg-nav" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 480h64C177.7 480 192 465.7 192 448S177.7 416 160 416H96c-17.67 0-32-14.33-32-32V128c0-17.67 14.33-32 32-32h64C177.7 96 192 81.67 192 64S177.7 32 160 32H96C42.98 32 0 74.98 0 128v256C0 437 42.98 480 96 480zM504.8 238.5l-144.1-136c-6.975-6.578-17.2-8.375-26-4.594c-8.803 3.797-14.51 12.47-14.51 22.05l-.0918 72l-128-.001c-17.69 0-32.02 14.33-32.02 32v64c0 17.67 14.34 32 32.02 32l128 .001l.0918 71.1c0 9.578 5.707 18.25 14.51 22.05c8.803 3.781 19.03 1.984 26-4.594l144.1-136C514.4 264.4 514.4 247.6 504.8 238.5z"/></svg>
        </a>

    <?php
            }
    ?>
</div>