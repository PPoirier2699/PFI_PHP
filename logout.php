<?php
    session_start();

    //load view content

    //variables used in the loaded module
    $title = "Logout";

    $module = "logoutview.php";
    $content = array();
    array_push($content, $module);
    require_once __DIR__ . "/HTML/masterpage.php";

?>