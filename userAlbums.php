<?php 
    include_once __DIR__ . "/UTILS/sessionHandler.php";
    session_start();

    $title = "user Album";
    $module = "userAlbumView.php";
   
    
    $content = array();
    array_push($content, $module);

    require_once __DIR__ . "/HTML/masterpage.php";

?>
