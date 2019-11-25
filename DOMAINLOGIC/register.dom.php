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
    $profilePicture = $_FILES['profilePicture'];

    Validator::validate_email($email);
    Validator::validate_password($pw);


    $user = new User();
    if(!$user->register($email,$username,$pw,$pwv, $profilePicture)){
        header("Location: ../error.php?ErrorMSG=Register%20error%20");
        die();
    }             
    header("Location: ../login.php");
    die();
?>