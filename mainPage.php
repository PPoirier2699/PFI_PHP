<?php
    session_start();

    //load view content
    $module = "mainPageview.php";
    $content = array();
    array_push($content, $module);

    //variables used in the loaded module
    $title = "Main page";

    //load the masterpage
    require_once __DIR__ . "/HTML/masterpage.php";

?>