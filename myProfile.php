<?php
    include_once __DIR__ . "/UTILS/sessionHandler.php";
    session_start();

    if(!validate_session()) {
        header("Location: login.php?ErrorMSG=Not Log in");
        die();
    }
    //load view content
    $module = "myProfileview.php";
    $content = array();
    array_push($content, $module);

    //variables used in the loaded module
    $title = "My Profile";

    //load the masterpage
    require_once __DIR__ . "/HTML/masterpage.php";

?>