<?php


function getUserProfil($idUser){
    $bdd = getBdd();
    $req = $bdd->query("SELECT email_Utlisateurs, mdp_Utilisateurs FROM utilisateurs WHERE id_Utilisateurs = $idUser");
    return $req;
}

function inscription($prenom, $mdp, $genre, $orientation, $mail){
    $bdd = getBdd();
    $insertmbr = $bdd->prepare('INSERT INTO utilisateurs (prenom_Utilisateurs, mdp_Utilisateurs, sexe_Utilisateurs, attirance_Utilisateurs, email_Utilisateurs, dateInscription_Utilisateurs, photo_Utilisateurs) VALUES(?, ?, ?, ?, ?, now(), "pp_0.svg")');
    $insertmbr->execute(array($prenom, $mdp, $genre, $orientation, $mail));
    return $insertmbr;
}

function getUserFromConnexion($mailconnect, $mdpconnect){
    $bdd = getBdd();
    $requsermail = $bdd->query("SELECT * FROM utilisateurs WHERE email_Utilisateurs='$mailconnect' AND mdp_Utilisateurs='$mdpconnect'");
    if($requsermail->rowCount() == 1){
        return $requsermail->fetch();
    }
    else{
        return -1;
    }

}

function getUserFromMail($mail){
    $bdd = getBdd();
    $reqmail = $bdd->prepare('SELECT * FROM utilisateurs WHERE email_Utilisateurs = ?');
	$reqmail->execute(array($mail));
    return $reqmail;
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

function updatePhoto($userId,$extensionUpload ){
    $updateavatar = $bdd->prepare("UPDATE utilisateurs SET photo_Utilisateurs= ? WHERE id_Utilisateurs = ?");
    $updateavatar->execute(array($userId.".".$extensionUpload,$userId));
    return $updateavatar;
}

function updateMdp($mdp, $userId){
    $insertmdp = $bdd->prepare("UPDATE utilisateurs SET mdp_Utilisateurs = ?  WHERE id_Utilisateurs=?");
    $insertmdp->execute(array($mdp,$userId));
    return $insertmdp;
}

function checkMailExist($mailconnect){
    $bdd = getBdd();
    $requsermail = $bdd->query("SELECT * FROM utilisateurs WHERE email_Utilisateurs='$mailconnect'");
    if($requsermail->rowCount() > 0){
        return 1;
    }
    else{
        return 0;
    }

}

function updateMail($mail, $userId){
    $insertemail = $bdd->prepare("UPDATE utilisateurs SET email_Utilisateurs = ? WHERE id_Utilisateurs=?");
	$insertemail->execute(array($mail, $userId));
}



?>