<?php 
    session_start();

    $title = "Search result";
    $module = "searchview.php";

    $content = array();
    array_push($content, $module);

    require_once __DIR__ . "/HTML/masterpage.php";

?>