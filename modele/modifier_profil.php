<?php
require_once("bdd/bdd.php");
require_once("../controleur/controleur.php");
require_once("etudiants_modele.php");
sessionConnexion();
$bdd = getBdd();
$erreur = "";
    if(isset($_POST['submitmodif'])) {
        $mail = trim(htmlspecialchars($_POST['mail']));
        $mdp = sha1($_POST['mdp']);
        if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
            $tailleMax = 2097152;
            $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
            if($_FILES['avatar']['size'] <= $tailleMax) {
               $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
               if(in_array($extensionUpload, $extensionsValides)) {;
                  $chemin = "../vue/img/avatar/".$_SESSION['IdUtilisateur'].".".$extensionUpload;
                  $photoresize = resize_crop_image(500, 500, $_FILES['avatar']['tmp_name'] , $_FILES['avatar']['tmp_name']);
                  $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                  if($resultat) {
                     $updateavatar = $bdd->prepare('UPDATE utilisateurs SET photo_Utilisateurs = :avatar WHERE id_Utilisateurs = :id');
                     $updateavatar->execute(array(
                        'avatar' => $_SESSION['IdUtilisateur'].".".$extensionUpload,
                        'id' => $_SESSION['IdUtilisateur']
                        ));
                     $_SESSION['PhotoUtilisateurs']=$_SESSION['IdUtilisateur'].".".$extensionUpload;                       
                  } else {
                     $erreur = "Erreur durant l'importation de votre photo de profil";
                  }
               } else {
                  $erreur = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
               }
            } else {
               $erreur = "Votre photo de profil ne doit pas dépasser 2Mo";
            }
        }
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
        if(!empty($_POST['mail']) || !empty($_POST['mdp']) || !empty($_FILES['avatar']['name']) ){
            header('Location: ../routeur.php/profil');
        }    
    }
    
    $_SESSION["erreur"]=$erreur;

?>