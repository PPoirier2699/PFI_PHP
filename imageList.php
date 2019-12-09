<?php
    include_once __DIR__ . "/UTILS/sessionHandler.php";


    session_start();
    //load view content
    $module = "imageListView.php";
    $module2 = "modalView.php";
    $content = array();
    array_push($content, $module);
    array_push($content, $module2);
    
    //variables used in the loaded module
    $title = "Album";

    //load the masterpage
    require_once __DIR__ . "/HTML/masterpage.php";

?>