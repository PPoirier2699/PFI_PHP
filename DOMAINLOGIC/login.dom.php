<?php

    include_once "../CLASSES/USER/user.php";
    include_once "../UTILS/formvalidator.php";

    session_start();

    if(isset($_SESSION["userID"]))
    {
        header("Location: ../login.php?ErrorMSG=already%20logged%20in!");
        die();
    }

    //prendre les variables du Post
    $email = $_POST["email"];
    $pw = $_POST["pw"];

    //Validation Posts
    $aUser = new User();

    //validateLogin
    if($aUser->Login($email, $pw))
    {
        //direcTion si le login est reussi
        header("Location: ../mainPage.php");
        die();
    }

    header("Location: ../login.php?ErrorMSG=invalid email or password");
    die();

?>
