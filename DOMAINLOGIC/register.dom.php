<?php
    include_once "../UTILS/formValidator.php";
    include_once "../CLASSES/USER/user.php";
    include_once "../CLASSES/USER/userTDG.php";

    session_start();
   
    if(!empty($error)){
        echo "<script>
                alert('$error');
            </script>";
    }

    $email = $_POST["email"];
    $username = $_POST["username"];
    $pw = $_POST["pw"];
    $pwv = $_POST["pwValidation"];
    $profilePictureURL = "URL";

    $valid = new Validator;
    $valid->validate_email($email);
    $valid->validate_password($pw);
    
    $user = new User;
    if($user->register($email,$username,$pw,$pwv,$profilePictureURL) == TRUE){
        $userTDG = UserTDG::getInstance();
        $_SESSION["userID"] = $userTDG->get_by_email($email)['id'];
        $_SESSION["userName"] = $userTDG->get_by_email($email)['username'];              
        header("Location: ../mainPage.php");
        die();
    } 
        header("Location: ../register.php?ErrorMSG=Register%20error");
        die();
?>