<?php
    include_once __DIR__ . "/../CLASSES/IMAGE/image.php";
    include_once __DIR__ . "/../UTILS/sessionHandler.php";
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";

    session_start();
    $albumID;
    
    if((validate_session() && $_POST["authorID"] == $_SESSION["userID"])) {
        $img = new Image();
        $albumID = $_POST["albumID"];
        $img->add_picture_to_album($_FILES["addpicture"], $_POST["albumID"], $_POST["description"]);
    }
    header("Location: ../imageList.php?albumID=$albumID");
    die();
?>