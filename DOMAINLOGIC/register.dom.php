<?php
    include_once "../UTILS/formValidator.php";
    include_once "../CLASSES/USER/user.php";
    //include_once "../CLASSES/USER/userTDG.php";

    session_start();

    //Verifier l'utiilite de ca, supprimer si inutile
    if(isset($_GET['ErrorMSG']))
        echo $_GET['ErrorMSG'];
   
    if(!empty($error)){
        echo "<script>
                alert('$error');
            </script>";
    }

    $email = $_POST["email"];
    $username = $_POST["username"];
    $pw = $_POST["pw"];
    $pwv = $_POST["pwValidation"];

    Validator::validate_email($email);
    Validator::validate_password($pw);
    

    $profilePicture = '';
    if(isset($_FILES['Media'])){
        $target_dir = "IMG/";
    
        //obtenir l'extention du fichier uploader
        $media_file_type = pathinfo($_FILES['Media']['name'] ,PATHINFO_EXTENSION);
        //$media_file_ext = strtolower(end(explode('.',$_FILES['Media']['name'])));
      
        // Valid file extensions
        $img_extensions_arr = array("jpg","jpeg","png","gif");
        $vid_extensions_arr = array("webm", "avi", "wmv", "rm", "rmvb", "mp4", "mpeg");
    
        // if(in_array($media_file_type, $img_extensions_arr)){
        //     $type = "image";
        //     echo "image";
        // }
        // else if(in_array($media_file_type, $vid_extensions_arr)){
        //     $type = "video";
        //     echo "video";
        // }
        // else{
        //     echo "INVALID FILE TYPE";
        //     die();
        // }
    
        //creation d'un nom unique pour la "PATH" du fichier
        $path = tempnam("../IMG", '');
        unlink($path);
        $file_name = basename($path, ".tmp");
        
        //creation de l'url pour la DB
        $url = $target_dir . $file_name . "." . $media_file_type;
        $profilePicture = $url;
        //deplacement du fichier uploader vers le bon repertoire (Medias)
        move_uploaded_file($_FILES['Media']['tmp_name'], "../" . $url);
    
    }


    $user = new User();
    if($user->register($email,$username,$pw,$pwv, $profilePicture)){
        $userTDG = new userTDG;
        $_SESSION["userID"] = $userTDG->get_by_email($email)['id'];
        $_SESSION["userName"] = $userTDG->get_by_email($email)['username'];              
        header("Location: ../billboard.php");
        die();
    } 
    header("Location: ../error.php?ErrorMSG=Register%20error%20");
    die();
?>