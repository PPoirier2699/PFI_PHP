<?php
  include "../CLASSES/USER/user.php";
  include "../UTILS/formValidator.php";
  
  session_start();

  $email = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["oldpw"];

  $user = new User();
  $user->load_user($_SESSION["userEmail"]);

  if (!password_verify($password, $user->get_password())) {
    header("Location: ../myProfile.php?ErrorMSG=You need to enter your password to change your info");
    die();
  }

  //verification des parametres
  if(empty($email) || empty($username)){
    header("Location: ../myProfile.php?ErrorMSG=invalid email or username");
    die();
  }

  if(!empty($email) && !Validator::validate_email($email)){
    $newmail = $email;
  } else {
    $newmail = $_SESSION["userEmail"];
  }
  
  if(!empty($username)){
    $newname = $username;
  }else{
    $newname = $_SESSION["userName"];
  }

  $user->update_user_info($_SESSION["userEmail"], $newmail, $newname);


  $oldpw = $_POST["oldpw"];
  $pw = $_POST["pw"];
  $pwV = $_POST["pwValidation"];

  if(!empty($oldpw) && !empty($pw) && !empty($pwV)) {
  //update le password
    if($pw != $pwV) {
      header("Location: ../myProfile.php?ErrorMSG=Passwords doesnt match");
      die();
    }

    if(empty($pw) || !Validator::validate_password($pw)){
      header("Location: ../myProfile.php?ErrorMSG=Password is not valid");
      die();
    }

    if(!$user->update_user_pw($_SESSION["userEmail"], $oldpw, $pw, $pwV)){
      header("Location: ../myProfile.php?ErrorMSG=invalid%20request");
      die();
    }
  }
  $newProfilePicture = $_FILES["profilePicChange"];

  if(!empty($newProfilePicture["name"])) {
    if(!$user->update_user_picture($_SESSION["userEmail"], $newProfilePicture)) {
      header("Location: ../myProfile.php?ErrorMSG=Invalid Image");
      die();
    }
  }

  header("Location: ../myProfile.php");
  die();
?>
