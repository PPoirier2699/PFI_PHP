<?php
    session_start();

    //load view content
    $module = "newAlbumview.php";
    $content = array();
    array_push($content, $module);

    //variables used in the loaded module
    $title = "New Album";

    //load the masterpage
    require_once __DIR__ . "/HTML/masterpage.php";

?>