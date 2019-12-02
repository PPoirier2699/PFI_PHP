<?php 
    require_once "./CLASSES/ALBUM/album.php";
    require_once "./CLASSES/COMMENT/comment.php";
    require_once "./CLASSES/IMAGE/image.php";
    require_once "./CLASSES/USER/user.php";
    session_start();

    $title = "searchResult";
    $titre = $_GET['search'];
    $module = "searchview.php";

    $content = array();
    array_push($content, $module);

    require_once __DIR__ . "/HTML/masterpage.php";

?>