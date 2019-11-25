<?php
    session_start();

    //load view content
    $module = "registerview.php";
    $content = array();
    array_push($content, $module);

    //variables used in the loaded module
    $title = "Register";

    //load the masterpage
    require_once __DIR__ . "/HTML/masterpage.php";

?>