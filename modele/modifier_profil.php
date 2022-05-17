<?php
require_once("bdd/bdd.php");
session_start();
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
                     header('Location: ../routeur.php/profil');                       
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
                header('Location: ../routeur.php/profil');
                    
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
                header('Location: ../routeur.php/profil');            
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
    function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
        $imgsize = getimagesize($source_file);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];
        switch($mime){
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;
            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 7;
                break;
            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 80;
                break;
            default:
                return false;
                break;
        }    
        $dst_img = imagecreatetruecolor($max_width, $max_height);
        $src_img = $image_create($source_file);
        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        if($width_new > $width){
            $h_point = (($height - $height_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        }else{
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
        } 
        $image($dst_img, $dst_dir, $quality);
        if($dst_img)imagedestroy($dst_img);
        if($src_img)imagedestroy($src_img);

    }
    $_SESSION["erreur"]=$erreur;
?>