<?php
    include_once __DIR__ . "/../CLASSES/ALBUM/albumTDG.php";
    session_start();

    $albumTDG = AlbumTDG::getinstance();

    $title = $_POST['title'];
    $authorID = $_SESSION['userID'];
    $descriptionAlbum = $_POST['descriptionAlbum'];
    $creationTime = date("Y-n-j");
    $imageURL = $_FILES['firstImage'];
    $descriptionImage = $_POST['descriptionImage'];

    if(!$albumTDG->add_album($title, $authorID, $descriptionAlbum, $creationTime,$imageURL,$descriptionImage)){
        header("Location: ../newAlbum.php?ErrorMSG=New%20album%20error!");
        die();
    }
    header("Location: ../myProfile.php");
    die();


?>

