<?php
    include_once __DIR__ . "/../CLASSES/IMAGE/image.php";
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";

    session_start();
    $albumID;
    if (isset($_GET["albumID"])) {
        $albumID = $_GET["albumID"];
    } else {
        header("Location: ../login.php?ErrorMSG=No albumID provided");
        die();
    }

    $img = new Image();
    $album = new Album();

    $album->load_album($albumID);

    $_SESSION["currentAlbumTitle"] = $album->get_title();
    //Set la variable de session avec les images de l'album courantes(que lutilisateur a clicke dessus ou autre)
    $_SESSION["currentAlbumImage"] = $img->load_all_image_by_album($albumID);

    header("Location: ../imageList.php");
    die();
?>