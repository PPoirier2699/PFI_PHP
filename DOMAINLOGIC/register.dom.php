<?php
    include_once "../UTILS/formValidator.php";
    include_once "../CLASSES/USER/user.php";
    //include_once "../CLASSES/USER/userTDG.php";

    session_start();

    $email = $_POST["email"];
    $username = $_POST["username"];
    $pw = $_POST["pw"];
    $pwv = $_POST["pwValidation"];
    $profilePicture = $_FILES['profilePicture'];

    Validator::validate_email($email);
    Validator::validate_password($pw);


    $user = new User();
    if(!$user->register($email,$username,$pw,$pwv, $profilePicture)){
        header("Location: ../register.php?ErrorMSG=Register%20error%20");
        die();
    }             
    header("Location: ../login.php");
    die();
?>
