<?php
    include_once __DIR__ . "/../CLASSES/ALBUM/albumTDG.php";
    session_start();

    $albumTDG = AlbumTDG::getinstance();

    $title = $_POST['title'];
    $authorID = $_SESSION['userID'];
    $description = $_POST['description'];
    $creationTime = date("Y-n-j");// 10, 3, 2001

    if(!$albumTDG->add_album($title, $authorID, $description, $creationTime)){
        header("Location: ../newAlbum.php?ErrorMSG=New%20album%20error!");
        die();
    }
    header("Location: ../myProfile.php");
    die();


?>

